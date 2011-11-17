<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_me extends SuperController {
    function before(){
        if(!isset($_SESSION['user']) || !$_SESSION['user']->logged_in()){
			$this->request->redirect('/');
		}
        parent::before();
        
    }
    
	public function action_index()
	{
	    $this->content = View::factory('mainMe');
	}
	public function action_editDetails(){
	    if(isset($_POST) && !empty($_POST) && $_SESSION['user']->getId() != 0){
	        $id = $_SESSION['user']->getId();
	        unset($_POST['userid'], $_POST['submit']);
	        // Make sure the checkboxes are caught.
	        $_POST['showPhone']     = (isset($_POST['showPhone'])     ? 1 : 0);
            $_POST['showPost']      = (isset($_POST['showPost'])      ? 1 : 0);
	        $_POST['showAllergies'] = (isset($_POST['showAllergies']) ? 1 : 0);
	        $_POST['showEmail']     = (isset($_POST['showEmail'])     ? 1 : 0);
	        user::change_user_details($id, $_POST);
	        //Clear the session and do a new login to update the sessiondata
	        unset($_SESSION['user']);
	        $_SESSION['user'] = user::instance()->login_by_user_id($id);
	    }
	    $this->content = View::factory('editUser');
	    $this->content->details = user::get_user_data($_SESSION['user']->getId());
	    $this->content->userId = $_SESSION['user']->getId();
	    $this->content->formTarget = '/me/editDetails';
	    $this->css[] = '/css/editUser.css';
	    $this->js[] = '/js/jquery.js';
	    $this->js[] = '/js/jquery.collapser.js';
	    $this->js[] = '/js/editUser.js';
        
	}
	public function action_editGroups(){
	    $this->content = View::factory('userGroups');
        $this->content->groups = user::get_user_groups($_SESSION['user']->getId());    
	}
	public function action_Mission(){
	    $missions = DB::select('*')
	                   ->from('lt_UserMission')
	                   ->join('mission')
	                   ->on('lt_UserMission.missionid', '=', 'mission.id')
	                   ->where('lt_UserMission.userid', '=', $_SESSION['user']->getId())
	                   ->execute()
	                   ->as_array();
	                   
        $responsible_missions = DB::select('mission.*')
	                   ->from('lt_UserOrganisation')
	                   ->join('mission')
	                   ->on('lt_UserOrganisation.organisationid', '=', 'mission.responsible_organisation')
	                   ->where('lt_UserOrganisation.userid', '=', $_SESSION['user']->getId())
	                   ->execute()
	                   ->as_array();
	    $this->content = View::factory('meMissions');
	    $this->content->responsible_missions = $responsible_missions;
	    $this->content->missions = $missions;
	}
	public function action_missionDetails($mission_id){
	    $this->content = View::factory('missionDetails');
	    list($this->content->missionDetails) = DB::select_array(array('mission.*', array('organisation.name', 'organisation_name')))
                                            ->from('mission')
                                            ->join('organisation')
                                            ->on('mission.responsible_organisation','=', 'organisation.id')
                                            ->execute()
                                            ->as_array();
                                            
        $is_responsible_for = DB::select('mission.id')
	                   ->from('lt_UserOrganisation')
	                   ->join('mission')
	                   ->on('lt_UserOrganisation.organisationid', '=', 'mission.responsible_organisation')
	                   ->where('lt_UserOrganisation.userid', '=', $_SESSION['user']->getId())
	                   ->where('mission.id','=', $mission_id)
	                   ->execute()
	                   ->as_array();
	    if(isset($is_responsible_for[0]['id']) && $is_responsible_for[0]['id'] == $mission_id){
	        $this->content->users = DB::select_array(array(DB::Expr('concat(user.fname, " ", user.lname) as name'), 'user.user_id', 'user.phone'))
                                    ->from('lt_UserMission')
                                    ->join('user')
                                    ->on('lt_UserMission.userid','=','user.user_id')
                                    ->where('lt_UserMission.missionid', '=', $mission_id)
                                    ->execute()
                                    ->as_array();
	    }
	}

} // End Welcome
