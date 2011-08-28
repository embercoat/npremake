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
	}
	public function action_commit(){
	    $post = Validation::factory($_POST);
        $post
            ->rule('reg_username', 'user::free_username')
            ->rule('reg_username', 'min_length', array(':value', '6'))
            ->rule('reg_password', 'min_length', array(':value', '6'))
            ->rule('reg_password', 'not_empty')
            ->rule('fname', 'not_empty')
            ->rule('lname', 'not_empty');
        if($post->check()){
            if($post['reg_password'] == $post['password2']){
                user::create_user($_POST['fname'],$_POST['lname'],$_POST['reg_username'],$_POST['reg_password']);
                $_SESSION['message']['success'][] = 'Du är nu registrerad!';
                
            } else {
                $_SESSION['message']['fail'][] = 'Dina lösenord matchade inte.';
            }
        } else {
            $errors = $post->errors();
            if(isset($errors['reg_username'])){
                switch($errors['reg_username'][0]){
                    case 'min_length':
                        $_SESSION['message']['fail'][] = 'Ditt användarnamn är för kort. (minst 6 tecken)';
                    break;
                    case 'user::free_username':
                        $_SESSION['message']['fail'][] = 'Det användarnamnet är redan taget.';
                    break;
                }
            }
            if(isset($errors['reg_password'])){
                $_SESSION['message']['fail'][] = 'Ditt lösenord är för kort. (minst 6 tecken)';
            }
            if(isset($errors['fname'])){
                $_SESSION['message']['fail'][] = 'Du måste ange förnamn.';
            }
            if(isset($errors['lname'])){
                $_SESSION['message']['fail'][] = 'Du måste ange efternamn.';
            }
            
        }
	}

} // End Welcome
