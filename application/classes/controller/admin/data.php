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
	    $this->content->organisations = DB::select_array(array('organisation.*', 'organisation_type.type'))
	                        ->from('organisation')
	                        ->join('organisation_type')
	                        ->on('organisation.type', '=', 'organisation_type.id')
	                        ->execute()->as_array();
	}
	public function action_delOrganisation($id){ 
	    DB::delete('organisation')
	        ->where('id', '=', $id)
	        ->execute();
	   $this->request->redirect('/admin/data/organisation');
	}
	public function action_editOrganisation($id){
	    $this->content = View::Factory('admin/data/editOrganisation');
	    $this->css[] = '/css/form.css';
	    if($id !== 'new'){
		    list($data) = DB::select('*')
		                    ->from('organisation')
		                    ->where('organisation.id', '=', $id)
		                    ->execute()
		                    ->as_array();
		    $members = DB::select('*')
		                    ->from('lt_UserOrganisation')
		                    ->join('user')
		                    ->on('lt_UserOrganisation.userid', '=', 'user.user_id')
		                    ->where('lt_UserOrganisation.organisationid', '=', $id)
		                    ->execute()
		                    ->as_array();
		    
		    $this->content->data = $data;
		    $this->content->members = $members;
	    } else {
	        $this->content->data = false;
	        $this->content->members = array();
	    }
        $organisation_types = array();
        foreach(DB::select('*')->from('organisation_type')->execute()->as_array() as $ot)
            $organisation_types[$ot['id']] = $ot['type'];
        $this->content->organisation_types = $organisation_types;
            
	}
	public function action_updateOrganisation(){
	    $this->js = '/js/admin/data.js';
	    $organisationid = $_POST['organisationid'];
	    unset($_POST['organisationid']);
	    if($organisationid == 'new'){
	        list($organisationid, $num_rows) = DB::insert('organisation', array('name', 'description', 'type'))
	            ->values(array(
	                $_POST['name'],
	                $_POST['description'],
	                $_POST['type']
	            ))
	            ->execute();
	       
	    } else {
		    DB::update('organisation')
		            ->set($_POST)
		            ->where('id', '=', $organisationid)
		            ->execute();
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
}
			



?>