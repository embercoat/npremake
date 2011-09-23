<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_me extends SuperController {
    function before(){
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
	    $this->content = View::factory('meMissions');
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
	}

} // End Welcome
