<?php
class phosare extends user {
    static function get_phosare_fields($fields = false, $id = false, $order_by = false){
        if($fields == false)
            $fields = array('user.fname', 'user.lname', 'user.user_id');

        if(!is_array($fields))
            $fields = array($fields);

        $sql = DB::select_array($fields)
                ->from('user')
                ->join('lt_UserGroup')
                ->on('lt_UserGroup.userid', '=', 'user.user_id')
                ->where('lt_UserGroup.year', '=', date('Y'));

        if(is_string($order_by))
            $sql->order_by($fields);

        if(is_array($order_by))
            foreach($order_by as $field)
                if(is_array($field))
                    $sql->order_by($field[0], $field[1]);
                else
                    $sql->order_by($field);

        if($id !== false){
            $sql->where('user_id', '=', $id);
        }
        return $sql->execute()->as_array();
    }
    static function get_users_from_membertype($membertype, $year = false){
        $sql =  DB::select('userid')
            ->from('lt_UserGroup')
            ->where('type', '=', $membertype)
            ->where('year', '=', (($year !== false) ? $year : date('Y')));
        return $sql->execute()
            ->as_array();
    }
    static function get_users_from_group($group, $year = false){
        $sql =  DB::select('userid')
            ->from('lt_UserGroup')
            ->where('groupid', '=', $group)
            ->where('year', '=', (($year !== false) ? $year : date('Y')));
        return $sql->execute()
            ->as_array();
    }

}


?>