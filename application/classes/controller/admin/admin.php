<?php
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_Admin extends SuperAdminController{
	function before(){
        parent::before();
	}
	public function action_index(){
		$this->content = View::Factory('admin/welcome');
	}
}
			



?>