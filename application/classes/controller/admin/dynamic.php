<?php
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_Dynamic extends SuperAdminController{
	function before(){
        parent::before();
	}
	public function action_index(){
	    $sub = DB::select('id', 'page', 'edited', 'edited_by')->from('dynamic')->order_by('edited', 'DESC');
	    $dynamics = DB::select('*')->from(array($sub, 'temp'))->group_by('page')->execute()->as_array();
		$this->content = View::Factory('admin/dynamic/mainDynamics');
		$this->content->dynamics = $dynamics;
	}
}
			



?>