<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_Fixer extends SuperAdminController{
	function before(){
        parent::before();
	}
	public function action_index(){
	    $groups = DB::select('*')
	        ->from('lt_UserGroup')
	        ->where('lt_UserGroup.year', '=', date('Y'))
	        ->execute()->as_array();
	    var_dump($groups);
	    foreach($groups as $g){
	        Model::factory('postfix')->user_group_change($g['groupid']);
	    }
	}
}




?>