<?php defined('SYSPATH') OR die('No Direct Script Access');
/*
 * CREATE TABLE `list` (
  `idlist` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `require_moderation` tinyint(4) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `visible` int(11) DEFAULT NULL,
  `open` int(11) DEFAULT NULL,
  PRIMARY KEY (`idlist`)
) DEFAULT CHARSET=latin1

CREATE TABLE `list_data` (
  `id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `confirmed` int(11) DEFAULT NULL,
  PRIMARY KEY (`list_id`,`user`)
) ENGINE=InnoDB DEFAULT


 */
Class Model_list extends Model {
    function get_lists($only_visible = false){
        $sql = DB::select_array(
            array(
                'list.*',
                    DB::expr(
                    '('.
                    DB::select(DB::expr('count(1)'))
                        ->from('list_data')
                        ->where(DB::expr('list_id'), '=', DB::expr('idlist'))
                    .') as count')
                )
            )
        ->from('list')
        ->order_by('name', 'asc');
        if($only_visible)
            $sql->where('visible', '=', '1');
        return $sql->execute()->as_array();
    }
    function get_list($id){
        list($list) = DB::select('*')->from('list')->where('idlist', '=', $id)->execute()->as_array();
        return $list;
    }
    function delete_list($id){
        DB::delete('list')->where('idlist', '=', $id)->execute();
        DB::delete('list_data')->where('list_id', '=', $id)->execute();
    }
    function create($name, $description, $visible, $open, $require_moderation){
        return DB::insert('list', array('name', 'description', 'require_moderation', 'visible', 'open'))
            ->values(array(
                    $name,
                    $description,
                    $require_moderation,
                    $visible,
                    $open
                    ))
            ->execute();
    }
    function update($id, $name = null, $description = null, $visible = null, $open = null, $require_moderation = null){
        $fields = array();
        if(!is_null($name))                $fields['name']              = $name;
        if(!is_null($description))         $fields['description']       = $description;
        if(!is_null($visible))             $fields['visible']           = $visible;
        if(!is_null($open))                $fields['open']              = $open;
        if(!is_null($require_moderation))  $fields['require_moderation'] = $require_moderation;
        DB::update('list')->set($fields)->where('idlist', '=', $id)->execute();
    }
    function get_participants($list){
        return DB::select_array(array('list_data.*', 'user.fname', 'user.lname', 'user.allergies', 'user.socialsecuritynumber'))
            ->from('list_data')
            ->join('user')
            ->on('list_data.user', '=', 'user.user_id')
            ->where('list_data.list_id', '=', $list)
            ->order_by('user.fname', 'ASC')
            ->order_by('user.lname', 'ASC')
            ->execute()->as_array();
    }
    function is_participant($user_id, $list_id){
        list($return) = DB::select(DB::expr('count(1) as count'))
            ->from('list_data')
            ->where('list_id', '=', $list_id)
            ->where('user', '=', $user_id)
            ->execute()->as_array();
        return $return['count'];
    }
    function is_confirmed($user_id, $list_id){
        list($return) = DB::select(DB::expr('count(1) as count'))
            ->from('list_data')
            ->where('list_id', '=', $list_id)
            ->where('user', '=', $user_id)
            ->where('confirmed', '=', '1')
            ->execute()->as_array();
        return $return['count'];
    }
    function is_open($list_id){
        list($return) = DB::select('open')->from('list')->where('idlist', '=', $list_id)->execute()->as_array();
        return $return['open'];
    }

    function add_participant($users, $list){
        if(!is_array($users))
            $users = array($users);
        $insert = DB::insert('list_data', array('list_id', 'user'))->ignore(true);
        foreach($users as $u){
            $insert->values(array($list, $u));
        }
        $insert->execute();
    }
    function remove_participant($users, $list){
        if(!is_array($users))
            $users = array($users);
        $delete = DB::delete('list_data')->where('user', 'IN', $users)->where('list_id', '=', $list)->execute();
    }
    function confirm_participant($userid, $listid){
        DB::update('list_data')->set(array('confirmed' => '1'))->where('list_id', '=', $listid)->where('user', '=', $userid)->execute();
    }
    function unconfirm_participant($userid, $listid){
        DB::update('list_data')->set(array('confirmed' => '0'))->where('list_id', '=', $listid)->where('user', '=', $userid)->execute();
    }

}
