<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_register extends SuperController {
    function before(){
        parent::before();
    }
	public function action_index()
	{
	    $this->content = View::factory('registeruser');
	    if(isset($_POST) && !empty($_POST)){
    	    $post = Validation::factory($_POST);
            $post
                ->rule('reg_username', 'min_length', array(':value', '6'))
                ->rule('reg_username', 'not_empty')
                ->rule('reg_username', 'user::free_username')
                ->rule('reg_password', 'min_length', array(':value', '6'))
                ->rule('reg_password', 'not_empty')
                ->rule('reg_password', 'matches', array(':validation', 'reg_password', 'password2'))
                ->rule('socialsecuritynumber', 'not_empty')
                ->rule('socialsecuritynumber', array('user', 'check_ssn'), array(':value'))
                ->rule('email', 'email')
                ->rule('tos', 'not_empty')
                ->rule('fname', 'not_empty')
                ->rule('lname', 'not_empty');

            if($post->check()){
                user::create_user($_POST['fname'],$_POST['lname'],$_POST['reg_username'],$_POST['reg_password'], $_POST['socialsecuritynumber']);
                $_SESSION['message']['success'][] = 'Du är nu registrerad!';
            } else {
                $_SESSION['message']['fail'] = $post->errors('form_errors');
                $this->content->details = $_POST;
            }
	    }
	}

} // End Welcome
