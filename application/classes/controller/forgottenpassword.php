<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_forgottenpassword extends SuperController {
    function before(){
        parent::before();
    }
	public function action_index()
	{
	    $this->content = View::factory('forgottenpassword');
	    if(isset($_POST) && !empty($_POST)){
	        $userid = DB::select('user_id')->from('user')->where('email', '=', $_POST['email'])->execute()->as_array();
	        if(count($userid) == 1){
	            $newpass = user::generate_password();

	            $mail = Model::factory('mail')
	                    ->to($_POST['email'])
	                    ->from('npg@nolleperioden.se')
	                    ->subject('Nytt Lösenord')
	                    ->body(View::factory('mail/newpassword')->set('newpass', $newpass))
	                    ->send();

	            user::change_passsword($userid[0]['user_id'], $newpass);
	            $_SESSION['message']['warning'][] = 'Om adressen fanns har ett nytt lösenord skickats till denna.';
	        }
	    }
	}

} // End Welcome
