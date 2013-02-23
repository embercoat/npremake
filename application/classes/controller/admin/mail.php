<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_Mail extends SuperAdminController{
	function before(){
        parent::before();
	}
	public function action_index(){
	    $this->css[] = '/css/form.css';
	    $this->css[] = '/css/mail.css';
	    $this->js[] = '/js/jquery.ui.js';
		$this->content = View::Factory('admin/mail/mail');
		$this->content->groups = user::get_group();
		$this->content->phosare = phosare::get_phosare_fields();
		$this->content->membertypes = user::get_membertype();
	}
	public function action_send(){
	    $user_membertype = array();
	    if(isset($_POST['membertype']))
	        foreach($_POST['membertype'] as $mt){
	            $user_membertype = array_merge($user_membertype, phosare::get_users_from_membertype($mt));
	        }

        if(isset($_POST['group']))
            foreach($_POST['group'] as $g){
                $user_group = array_merge($user_membertype, phosare::get_users_from_group($g));
        }
        foreach($user_group as &$ug) $ug = $ug['userid'];
        foreach($user_membertype as &$mt) $mt = $mt['userid'];


	    $recipients = array_unique(array_merge($user_group, $user_membertype, $_POST['phosare']));
	    foreach($recipients as $r){
	        list($store) = user::get_user_fields('email', $r);
	        if($store['email'] != NULL){
    	        $mail = Model::factory('mail')
    	        ->to($store['email'])
    	        ->subject($_POST['subject'])
    	        ->body($_POST['body']);
    	        $mail->send();
	        }
	    }
	}
}




?>
