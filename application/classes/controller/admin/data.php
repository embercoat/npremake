<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_data extends SuperAdminController{
	function before(){
        parent::before();
	}
	public function action_index(){
		$this->content = View::Factory('admin/welcome');
	}
	public function action_program(){
	    $this->js[] = '/js/jquery.js';
	    $this->js[] = '/js/admin/data.js';
	    $programs = DB::select('*')
                        ->from('program')
                        ->order_by('name', 'asc')
                        ->execute()
                        ->as_array();
        $this->content = View::Factory('admin/data/programs');
        $this->content->programs = $programs;

	}
	public function action_delProgram($pid){
	    DB::delete('program')
	        ->where('id', '=', $pid)
	        ->limit(1)
	        ->execute();
	    DB::update('user')
            ->set(array('programId' => 37))
            ->where('programId','=', $pid)
            ->execute();

        $_SESSION['messages']['success'][] = 'Successfully removed pid '.$pid;
	    $this->request->redirect('/admin/data/program');
	}
	public function action_editProgram(){
	    if($_POST['program_id'] !== 'new'){
	        if($_POST['oldname'] == $_POST['newname']){
//	            $_SESSION['messages']['warning'][] = 'No difference between new and old name. Not changed.';
	        } else {
		        DB::update('program')
			        ->set(array('name' => $_POST['newname']))
			        ->where('id', '=', $_POST['program_id'])
			        ->execute();
//			    $_SESSION['messages']['success'][] = 'Successfully changed <b>'. $_POST['oldname'] .'</b> to <b>'.$_POST['newname'].'</b>';
	        }
	    } else {
	        DB::insert('program', array('name'))
	            ->values(array('name' => $_POST['newname']))
	            ->execute();
//            $_SESSION['messages']['success'][] = 'Successfully added <b>'.$_POST['newname'].'</b> to available programs';
	    }
        $this->request->redirect('/admin/data/program');

	}
	public function action_organisation(){
	    $this->content = View::Factory('admin/data/organisation');
	    $this->content->organisations = Model::factory('organisation')->get_organisation();
	}
	public function action_addusertoorganisation(){
	    Model::factory('organisation')->add_user_to_org(
	                $_POST['organisationid'],
	                $_POST['userid'],
	                $_POST['title'],
	                (isset($_POST['is_admin']) ? 1:0)
	           );
	    $this->request->redirect('/admin/data/editOrganisation/'.$_POST['organisationid']);
	}

	public function action_delOrganisation($id){
	    Model::factory('organisation')->del_organisation();
	   $this->request->redirect('/admin/data/organisation');
	}
	public function action_editOrganisation($id){
	    $this->content = View::Factory('admin/data/editOrganisation');
	    $this->css[] = '/css/form.css';
	    $this->css[] = '/css/jquery.ui.css';
	    $this->js[] = '/js/jquery.ui.js';
	    $this->js[] = '/js/jquery.hotkeys.js';
	    $this->js[] = '/js/admin/data/organisation.js';
	    $this->js[] = '/js/xmlrpc.js';

	    if($id !== 'new'){
		    list($data) = Model::factory('organisation')->get_organisation($id);
		    $this->content->data = $data;
		    $this->content->members = Model::factory('organisation')->get_organisation_members($id);
	    } else {
	        $this->content->data = false;
	        $this->content->members = array();
	    }
        $organisation_types = array();
        foreach(Model::factory('organisation')->get_organisation_types() as $ot)
            $organisation_types[$ot['id']] = $ot['type'];
        $this->content->organisation_types = $organisation_types;

	}
	public function action_updateOrganisation(){
	    $this->js = '/js/admin/data.js';
	    $organisationid = $_POST['organisationid'];
	    unset($_POST['organisationid']);
	    if($organisationid == 'new'){
	        $organisationid = Model::factory('organisation')->add_organisation($_POST['name'], $_POST['description'], $_POST['type']);
	    } else {
	        Model::factory('organisation')->update_organisation($organisationid, $_POST);
	    }
        $this->request->redirect('/admin/data/editOrganisation/'.$organisationid);
	}
	public function action_homeroom(){
        $this->js[] = '/js/admin/data.js';

	    $this->content = View::factory('admin/data/homeroom');
	    $this->content->homerooms = DB::select('*')
	                ->from('homeroom')
	                ->order_by('room', 'ASC')
	                ->execute()
	                ->as_array();
	}
    public function action_editHomeroom(){
	    if($_POST['homeroom_id'] !== 'new'){
	        if($_POST['oldname'] == $_POST['newname']){
	        } else {
		        DB::update('homeroom')
			        ->set(array('room' => $_POST['newname']))
			        ->where('homeroom_id', '=', $_POST['homeroom_id'])
			        ->execute();
	        }
	    } else {
	        DB::insert('homeroom', array('room'))
	            ->values(array('room' => $_POST['newname']))
	            ->execute();
	    }
        $this->request->redirect('/admin/data/homeroom');
	}
    public function action_delHomeroom($id){
	    DB::delete('homeroom')
	        ->where('homeroom_id', '=', $id)
	        ->limit(1)
	        ->execute();
	    DB::delete('lt_HomeroomGroup')
            ->where('homeroom','=', $id)
            ->execute();
	    $this->request->redirect('/admin/data/homeroom');
	}

	###   Attendance

	public function action_attendance(){
	    $this->js[] = '/js/admin/data.js';

	    $this->content = View::factory('admin/data/attendance');
	    $this->content->lists = Model::factory('attendance')->get_lists();

	}

	public function action_editattendance(){
	    if($_POST['attendance_id'] !== 'new'){
	        Model::factory('attendance')->change_name($_POST['attendance_id'], $_POST['newname']);
	    } else {
	        Model::factory('attendance')->create_attendance($_POST['newname']);
	    }
	    $this->request->redirect('/admin/data/attendance');
	}

	public function action_delattendance($id){
	    Model::factory('attendance')->delete_attendance($id);
	    $this->request->redirect('/admin/data/attendance');
	}
}
?>