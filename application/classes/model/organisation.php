<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Model_organisation extends Model {
    function get_organisation($id = false){
        $sql = DB::select_array(array('organisation.*', array('organisation_type.type', 'typename')))
                    ->from('organisation')
                    ->join('organisation_type')
                    ->on('organisation.type', '=', 'organisation_type.id');
        if($id !== false)
            $sql->where('organisation.id', '=', $id);

        return $sql->execute()->as_array();
    }
    function del_organisation($id){
        DB::delete('organisation')
            ->where('id', '=', $id)
            ->execute();
    }
    function add_organisation($name, $description, $type){
        list($organisationid, $num_rows) = DB::insert('organisation', array('name', 'description', 'type'))
        ->values(array(
                $name,
                $description,
                $type
        ))
        ->execute();
        return $organisationid;
    }
    function get_organisation_members($id){
        return DB::select('*')
        ->from('lt_UserOrganisation')
        ->join('user')
        ->on('lt_UserOrganisation.userid', '=', 'user.user_id')
        ->where('lt_UserOrganisation.organisationid', '=', $id)
        ->execute()
        ->as_array();
    }
    function get_organisation_types(){
        return DB::select('*')->from('organisation_type')->execute()->as_array();
    }
    function update_organisation($id, $pairs){
        DB::update('organisation')
        ->set($pairs)
        ->where('id', '=', $id)
        ->execute();

    }
    function add_user_to_org($orgid, $userid, $title, $is_admin = false){
        $sql = DB::insert('lt_UserOrganisation', array('userid', 'organisationid', 'title', 'isAdmin'))->ignore(true)
                ->values(array(
    	            $userid,
    	            $orgid,
    	            $title,
    	            ($is_admin)
    	        ));
        $sql->execute();
    }
}
