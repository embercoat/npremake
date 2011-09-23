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
	            $_SESSION['messages']['warning'][] = 'No difference between new and old name. Not changed.';
	        } else {
		        DB::update('program')
			        ->set(array('name' => $_POST['newname']))
			        ->where('id', '=', $_POST['program_id'])
			        ->execute();
			    $_SESSION['messages']['success'][] = 'Successfully changed <b>'. $_POST['oldname'] .'</b> to <b>'.$_POST['newname'].'</b>';
	        }
	    } else {
	        DB::insert('program', array('name'))
	            ->values(array('name' => $_POST['newname']))
	            ->execute();
            $_SESSION['messages']['success'][] = 'Successfully added <b>'.$_POST['newname'].'</b> to available programs';
	    }
        $this->request->redirect('/admin/data/program');
	        
	}
	public function action_organisation($id = FALSE){
	    $this->content = View::Factory('admin/data/organisation');
	    $this->content->organisations = DB::select('*')
	                        ->from('organisation')
	                        ->join('organisation_type')
	                        ->on('organisation.type', '=', 'organisation_type.id')
	                        ->execute()->as_array();
	   
	}
	public function action_delOrganisation($id){ 
	    
	}
	public function action_editOrganisation($id){
	    $this->content = View::Factory('admin/data/editOrganisation');
	    $this->css[] = '/css/form.css';
	    
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
	    $organisation_types = array();
	    foreach(DB::select('*')->from('organisation_type')->execute()->as_array() as $ot)
	        $organisation_types[$ot['id']] = $ot['type'];
	    
        $this->content->organisation_types = $organisation_types;
	    $this->content->data = $data;
	    $this->content->members = $members;
	}
	public function action_updateOrganisation(){
	    $organisationid = $_POST['organisationid'];
	    unset($_POST['organisationid']);
	    var_dump($_POST);
	    DB::update('organisation')
	            ->set($_POST)
	            ->execute();
		
        $this->request->redirect('/admin/data/editOrganisation/'.$organisationid);
	}
		
}
			



?>