<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_phmission extends SuperAdminController{
	function before(){
        parent::before();
	}
	public function action_index(){
		$this->action_list();
	}
	public function action_list(){
	    $this->content = View::Factory('admin/phmission/missionList');

	    $this->content->missions = DB::select('*')
	            ->from('mission')
	            ->order_by('startdate', 'ASC')
	            ->execute()
	            ->as_array();
	}
	public function action_edit($mission_id = 'new'){
	    $this->content = View::Factory('admin/phmission/editMission');
	    $this->js[] = '/js/anytime/anytime.c.js';
	    $this->css[] = '/css/anytime/anytime.c.css';
	    $this->css[] = '/css/form.css';
	    $this->css[] = '/css/jquery.ui.css';
	    $this->js[] = '/js/jquery.hotkeys.js';
	    $this->js[] = '/js/jquery.ui.js';
	    $this->js[] = '/js/xmlrpc.js';
	    $this->js[] = '/js/admin/phmission.js';

/* TODO
 * fix the autocomplete
 */
	    if(!empty($_POST)){
	        if($_POST['mission_id'] == 'new'){
		        list($mission_id, $null) = DB::insert('mission', array('name', 'description', 'startdate', 'enddate', 'responsible_organisation'))
		            ->values(array(
		                'name'         => $_POST['name'],
		                'description'  => $_POST['description'],
		                'startdate'	   => $_POST['starttime'],
		                'enddate'      => $_POST['endtime'],
		            	'responsible_organisation' => $_POST['responsible_organisation']
		            ))
		            ->execute();
		            $this->request->redirect('/admin/phmission/edit/'.$mission_id);
	        } else {
	            DB::update('mission')
		            ->set(array(
		                'name'         => $_POST['name'],
		                'description'  => $_POST['description'],
		                'startdate'	   => $_POST['starttime'],
		                'enddate'      => $_POST['endtime'],
		                'responsible_organisation' => $_POST['responsible_organisation']
		            ))
		            ->where('id','=',$_POST['mission_id'])
		            ->execute();
	        }
	    }
	    if($mission_id !== 'new'){
		    list($data) = DB::select('*')
		                    ->from('mission')
		                    ->where('id','=',$mission_id)
		                    ->execute()
		                    ->as_array();
		    $this->content->mission = $data;
		}
		$this->content->organisations = array('0' => '- Ingen');
		foreach(DB::select('*')->from('organisation')->order_by('name', 'ASC')->execute()->as_array() as $org)
		    $this->content->organisations[$org['id']] = $org['name'];

	    $this->js[] = '/js/jquery.ui.timepicker.js';
	    $this->js[] = '/js/jquery.ui.js';
	    $this->css[] = '/css/form.css';
	    $this->css[] = '/css/jquery.ui.css';
	    $this->css[] = '/css/jquery-ui-timepicker.css';
	    $this->content->mission_id = $mission_id;
	    $this->content->users = DB::select_array(array(DB::Expr('concat(user.fname, " ", user.lname) as name'), 'user.user_id'))
                                    ->from('lt_UserMission')
                                    ->join('user')
                                    ->on('lt_UserMission.userid','=','user.user_id')
                                    ->where('lt_UserMission.missionid', '=', $mission_id)
                                    ->execute()
                                    ->as_array();
	}
	public function action_delMission($id){
	    DB::delete('mission')
	        ->where('id', '=', $id)
	        ->execute();
	    DB::delete('lt_UserMission')
	        ->where('missionid','=', $id)
	        ->execute();
	    $_SESSION['messages']['success'][] = 'Mission successfully deleted';
        $this->request->redirect('/admin/phmission/list/');
	}
	public function action_rmUser($mission_id, $user_id){
	    DB::delete('lt_UserMission')
	        ->where('missionid', '=', $mission_id)
	        ->where('userid', '=', $user_id)
	        ->execute();
	        $_SESSION['messages']['success'][] = 'User successfully removed';
	        $this->request->redirect('/admin/phmission/edit/'.$mission_id);
	}
}




?>