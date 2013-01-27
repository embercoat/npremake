<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_json extends SuperController {
    function before(){
        if(!isset($_SESSION['user']) || !$_SESSION['user']->logged_in())
        	die();
        parent::before();

    }
    function after(){
        //Do nothing to suppres standard output.
    }
	public function action_index()
	{
	    //Do nothing here
	}
    public function action_getGroups(){
	    echo json_encode(user::get_group());
	}
	public function action_getRole(){
	    echo json_encode(user::get_membertype());
	}
	public function action_getMission(){
	    echo json_encode(DB::select_array(array('id', 'name'))
	                    ->from('mission')
	                    ->order_by('name', 'ASC')
	                    ->execute()
	                    ->as_array());
	}
    public function action_getHomeroom(){
	    echo json_encode(DB::select_array(array('homeroom_id', 'room'))
	                    ->from('homeroom')
	                    ->order_by('room', 'ASC')
	                    ->execute()
	                    ->as_array());
	}
    public function action_getOrganisation(){
	    echo json_encode(DB::select_array(array('id', 'name'))
	                    ->from('organisation')
	                    ->order_by('name', 'ASC')
	                    ->execute()
	                    ->as_array());
	}
}
