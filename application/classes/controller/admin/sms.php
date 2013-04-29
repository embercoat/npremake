<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_sms extends SuperAdminController{
	function before(){
        parent::before();
	}
	public function action_index(){
	    $this->css[] = '/css/form.css';
	    $this->css[] = '/css/mail.css';
	    $this->js[] = '/js/jquery.ui.js';
		$this->content = View::Factory('admin/sms/sms');
	}
	public function action_send(){
	    $user_membertype = array();
	    $recipients = array();
	    if(isset($_POST['membertype'])){
	        foreach($_POST['membertype'] as $mt){
	            $user_membertype = array_merge($user_membertype, phosare::get_users_from_membertype($mt));
	        }
	        foreach($user_membertype as &$mt) $mt = $mt['userid'];
	        $recipients = array_merge($recipients, $user_membertype);
	    }

        if(isset($_POST['group']))
            foreach($_POST['group'] as $g){
                $user_group = array_merge($user_membertype, phosare::get_users_from_group($g));
            foreach($user_group as &$ug) $ug = $ug['userid'];
            $recipients = array_unique(array_merge($recipients, $user_group));
        }

        if(isset($_POST['phosare'])){
            $recipients = array_unique(array_merge($recipients, $_POST['phosare']));
        }
	    foreach($recipients as $r){
	        list($store) = user::get_user_fields('phone', $r);
	        if($store['phone'] != NULL){
    	        $sms = Model::factory('sms')
    	        ->add_recipient($store['phone'])
    	        ->body($_POST['body']);
    	        $sms->send();
	        }
	    }

	    $this->content = View::factory('admin/sms/send');
	    $this->content->recipients = user::get_user_fields(array('fname', 'lname', 'phone'), $recipients);
	}
}




?>
