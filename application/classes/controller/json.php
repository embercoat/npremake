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

} // End Welcome
