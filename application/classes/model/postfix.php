<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Model_postfix extends Model {
    function __construct(){
        $this->config = Kohana::config('postfix');
    }
    /**
     *
     * @param string $alias the alias to be set
     * @param array $rec the recipients of the alias
     */
    function set_alias($alias, $rec){
        $postfix = Database::instance('postfix');
        $sql = DB::select('*')->from('alias')->where('address', '=', $alias.'@'.$this->config['domain']);
        $result = $postfix->query(Database::SELECT, $sql)->as_array();
        if(count($result)){
            //Update
            $sql = DB::update('alias')->set(array('goto' => implode("\n", $rec), 'modified' => date('Y-m-d H:i:s'), 'active' => (bool)count($rec)))->where('address', '=', $alias.'@'.$this->config['domain']);
            $postfix->query(Database::UPDATE, $sql);
        } else {
            //Insert
            $sql = DB::insert('alias', array('address', 'goto','domain', 'created', 'modified', 'active'))
                ->values(array(
                        $alias.'@'.$this->config['domain'],
                        implode("\n", $rec),
                        $this->config['domain'],
                        date('Y-m-d H:i:s'),
                        date('Y-m-d H:i:s'),
                        (bool)count($rec)
                        )
                    );
            $postfix->query(Database::INSERT, $sql);
        }

    }
    function user_group_change($group){
        $r = DB::select_array(array('user.email'))
            ->from('lt_UserGroup')
            ->join('user')
            ->on('lt_UserGroup.userid', '=', 'user.user_id')
            ->join('group')
            ->on('lt_UserGroup.groupid', '=', 'group.id')
            ->where('lt_UserGroup.groupid', '=', $group)
            ->where('lt_UserGroup.year', '=', date('Y'))
            ->execute()->as_array();
        $emails = array();
        $alias = '';
        list($shortname) = DB::select('shortname')->from('group')->where('id', '=', $group)->execute()->as_array();
        if(count($r)){
            foreach($r as $row){
                $emails[] = $row['email'];
            }
        }
        $this->set_alias(strtolower($shortname['shortname']), $emails);

    }
}