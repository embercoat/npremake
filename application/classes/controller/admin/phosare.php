<?php
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_phosare extends SuperAdminController{
	function before(){
        parent::before();
	}
	public function action_applicants($applicationId = false){
		if($applicationId === false){
		    //List them
		    $this->content = View::factory('admin/phosare/applicationList');
		    $applications = DB::select_array(array('a.*', DB::expr("Concat(u.fname, ' ', u.lname) as name")))
		                        ->from(array('applicant','a'))
		                        ->join(array('user', 'u'))
		                        ->on('a.userid', '=', 'u.user_id')
		                        ->where('approved', '=', '0')
		                        ->execute()
		                        ->as_array();
		    $this->content->applications = $applications;
		} else {
		    //show the specific application
		    $this->content = View::factory('admin/phosare/application');
		    list($application_data) = DB::select('*')
		                            ->from('applicant')
		                            ->where('id','=',$applicationId)
		                            ->execute()
		                            ->as_array();
            $this->content->application_data = $application_data;
		    $this->content->user_data = user::get_user_data($application_data['userid']);
		    $this->content->groups = user::get_user_groups($application_data['userid']);
		}
	}
	public function action_approveApplication(){
	    user::add_user_to_group($_POST['userid'], $_POST['addToGroup'], $_POST['asMemberType']);
	    DB::update('applicant')
	            ->set(array('approved' => 1, 'approvedBy' => $_SESSION['user']->getId()))
	            ->where('id', '=', $_POST['applicationid'])
	            ->execute();
	    $this->request->redirect('/admin/phosare/applicants/');
	}
}
			



?>