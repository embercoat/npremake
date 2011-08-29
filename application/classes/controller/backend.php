<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_backend extends SuperController {
    function before(){
        parent::before();
    }
    function after(){
        $this->request->redirect('/');
    }
	public function action_index()
	{
	    //Don't do anything. Just let after() redirect to start.
	}
	public function action_login(){
	    user::instance()->login_by_username_and_password($_POST['username'], $_POST['password']);
	    $_SESSION['user'] = user::instance();
	}
	public function action_logout(){
	    unset($_SESSION['user']);
	}
	

} // End Welcome
