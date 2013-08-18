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
	public function action_changePassword(){
	    $this->content = View::factory('me/changePassword');

	    if(isset($_POST) && !empty($_POST)){
	        $post = Validation::factory($_POST);
	        $post
	        ->rule('newpassword', 'min_length', array(':value', '6'))
	        ->rule('newpassword', 'not_empty')
	        ->rule('newpassword', 'matches', array(':validation', 'newpassword', 'newpassword2'))
	        ->rule('oldpassword', array('user', 'check_password'), array($_SESSION['user']->getId(), ':value'));

	        if($post->check()){
	            user::change_password($_SESSION['user']->getId(), $_POST['newpassword']);
	            $_SESSION['message']['success'][] = 'Ditt lösenord är ändrat';
	        } else {
	            $_SESSION['message']['fail'] = $post->errors('form_errors');
	            $this->content->details = $_POST;
	        }

	    }
	}
	public function action_editDetails(){
	    $this->content = View::factory('editUser');
	    $this->content->details = user::get_user_data($_SESSION['user']->getId());

	    if(isset($_POST) && !empty($_POST) && $_SESSION['user']->getId() != 0){
	        $post = Validation::factory($_POST);
	        $post
    	        ->rule('fname', 'not_empty')
    	        ->rule('lname', 'not_empty')
	            ->rule('phone', 'not_empty')
	        	->rule('socialsecuritynumber', 'not_empty')
	        	->rule('socialsecuritynumber', array('user', 'check_ssn'), array(':value'))
	            ->rule('cardnumber', 'not_empty')
	            ->rule('email', 'not_empty')
	            ->rule('email', 'email');

	        if($post->check()){
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
    	        $_SESSION['message']['success'][] = 'Dina uppgifter har uppdaterats';
	        } else {
                $_SESSION['message']['error'] = $post->errors('form_errors');
	            $this->content->details = array_merge($this->content->details, $_POST);
	        }
	    }
	    $this->content->userId = $_SESSION['user']->getId();
	    $this->content->formTarget = '/me/editDetails';

	    $this->content->unions = array();
	    foreach(user::get_unions() as $u)
	        $this->content->unions[$u['union_id']] = $u['name'];

	    $this->css[] = '/css/editUser.css';
	    $this->js[] = '/js/jquery.js';
	    $this->js[] = '/js/jquery.collapser.js';
	    $this->js[] = '/js/editUser.js';

	}
	public function action_editGroups(){
	    $this->content = View::factory('userGroups');
        $this->content->groups = user::get_user_groups($_SESSION['user']->getId());
	}
	public function action_groupDetails($id){
	    if(isset($_POST) && !empty($_POST)){
	        DB::insert('responsibility', array('user', 'group', 'start', 'end', 'priority'))
	            ->values(array(
	                    $_POST['user'],
	                    $_POST['group_id'],
	                    mktime(
                            (($_POST['starttime']['shift'] == 0) ? 6 : 18),
                            0,
                            0,
                            $_POST['starttime']['month'],
                            $_POST['starttime']['day']+1
                        ),
	                    mktime(
                            (($_POST['starttime']['shift'] == 0) ? 18 : 6),
                            0,
                            0,
                            $_POST['starttime']['month'],
                            (($_POST['starttime']['shift'] == 0) ? $_POST['starttime']['day'] : $_POST['starttime']['day']+1)+1
	                    ),
	                    $_POST['priority']
	            ))
	            ->execute();
	    }
	    $this->content = View::factory('groupDetails');
	    $this->js[] = '/js/me.js';
	    $this->js[] = '/js/jquery.ui.timepicker.js';
	    $this->js[] = '/js/jquery.ui.js';
	    $this->css[] = '/css/jquery.ui.css';
	    $this->css[] = '/css/jquery-ui-timepicker.css';
	    $this->content->homerooms = DB::select('*')
                    ->from('lt_HomeroomGroup')
                    ->where('group', '=', $id)
                    ->join('homeroom')
                    ->on('homeroom.homeroom_id', '=', 'lt_HomeroomGroup.homeroom')
                    ->execute()
                    ->as_array();
        $this->content->members = DB::select('u.fname', 'u.lname','u.user_id', 'u.phone', 'u.email', 'ltug.year', array('mt.name', 'membertype'))
	                ->from(array('lt_UserGroup', 'ltug'))
	                ->where('ltug.groupid','=',$id)
                    ->join(array('user', 'u'))
	                ->on('ltug.userid','=','u.user_id')
	                ->join(array('membertype', 'mt'))
	                ->on('ltug.type','=','mt.id')
	                ->order_by('u.lname')
	                ->execute()->as_array();
        list($this->content->group) = DB::select('*')->from('group')->where('id','=',$id)->execute()->as_array();
        $this->content->responsibilities = DB::select_array(array(
                        'responsibility.*',
                        'u.fname',
                        'u.lname',
                        'u.phone'
                    ))
                    ->from('responsibility')
                    ->join(array('user', 'u'))
                    ->on('responsibility.user','=','u.user_id')
                    ->where('group', '=', $id)
                    ->execute()
                    ->as_array();
    }
    public function action_delResponsibility($id){
        DB::delete('responsibility')->where('id', '=', $id)->execute();
        $this->request->redirect($_SERVER['HTTP_REFERER']);
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
	        $this->content->users = DB::select_array(
	                                    array(
	                                        DB::Expr('concat(user.fname, " ", user.lname) as name'),
	                                        'user.user_id',
	                                        'user.phone',
	                                        'lt_UserMission.spare',
	                                        'lt_UserMission.attended'
	                                    )
	                                )
                                    ->from('lt_UserMission')
                                    ->join('user')
                                    ->on('lt_UserMission.userid','=','user.user_id')
                                    ->where('lt_UserMission.missionid', '=', $mission_id)
                                    ->execute()
                                    ->as_array();
	    }
	}

} // End Welcome
