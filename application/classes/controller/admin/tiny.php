<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_tiny extends SuperAdminController{
	function before(){
        parent::before();
	}
	public function action_index(){
		$this->content = 'tiny';
		$mail = Model::factory('mail');
		$mail
		    ->to('kristian.nordman@scripter.se')
		    ->from('npg@nolleperioden.se')
		    ->subject('hello')
		    ->body('body')
		    ->send();
	}

}




?>