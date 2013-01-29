<?php
/**
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 */
class Controller_Admin_User extends SuperAdminController{
	function before(){
        parent::before();
	}
	public function action_index(){
		$this->content = View::Factory('admin/user/mainUser');
		$this->content->users = DB::select('user_id', 'username','fname','lname')
		                            ->from('user')
		                            ->order_by(DB::Expr('lname, fname'))
		                            ->execute()
		                            ->as_array();
	}
	public function action_editUser($userId = NULL){
	    $this->css[] = '/css/form.css';
	    if(is_null($userId)){
	        $_SESSION['messages']['fail'][] = 'Du måste ange ett Id';
	        $this->request->redirect($_SERVER['HTTP_REFERER']);
	    }
	    if(isset($_POST) && !empty($_POST) && ($_POST['userid'] == $_SESSION['user']->getId() || $_SESSION['user']->isAdmin())){
	        $id = $_POST['userid'];
	        unset($_POST['userid'], $_POST['submit']);
	        $_POST['showPhone'] = ((isset($_POST['showPhone']))? 1 : 0);
            $_POST['showPost'] = (isset($_POST['showPost'])? 1 : 0);
	        $_POST['showAllergies'] = (isset($_POST['showAllergies'])? 1 : 0);
	        $_POST['showEmail'] = (isset($_POST['showEmail'])? 1 : 0);
	        user::change_user_details($id, $_POST);
	    }
	    $this->content = View::factory('editUser');
	    $this->content->userId = $userId;
	    $this->content->details = user::get_user_data($userId);
	    $this->content->groups = user::get_user_groups($userId);
	    $this->content->formTarget = '/admin/user/editUser/'.$userId;
	    $this->css[] = '/css/editUser.css';
	    $this->js[] = '/js/jquery.js';
	    $this->js[] = '/js/jquery.collapser.js';
	    $this->js[] = '/js/editUser.js';
	    $this->content->unions = array();
	    foreach(user::get_unions() as $u)
	        $this->content->unions[$u['union_id']] = $u['name'];


	}
	public function action_delGroup($id){
	    user::del_group($id);
        $this->request->redirect($_SERVER['HTTP_REFERER']);

	}
	public function action_group(){
        $groups = DB::select('*')->from('group')->order_by('name')->execute();
        $this->content = View::factory('groupList');
	    $this->content->groups = $groups;
	}
	public function action_addGroup(){
        $this->css[] = '/css/form.css';
	    $this->content = View::factory($_SERVER['HTTP_REFERER']);
	}
	public function action_addToOrganisation(){
	    $organisation = $_POST['orgSelect'];
	    $sql = DB::insert('lt_UserOrganisation', array('userid', 'organisationid', 'title', 'isAdmin'));
	    foreach($_POST['userids'] as $userid){
	        $sql->values(array(
	            $userid,
	            $organisation,
	            $_POST['role'][$userid],
	            (isset($_POST['makeAdmin'][$userid]) ? 1:0)
	        ));
	    }
	    $sql->execute();
	    $_SESSION['messages']['success'][] = 'Användarna har lagts till i organisationen.';
	    $this->request->redirect($_SERVER['HTTP_REFERER']);
	}
	public function action_editGroup($id){
	    if(isset($_POST) && !empty($_POST)){
	        if($id == 'new'){
	            list($id, $null) = DB::insert('group', array('name', 'shortname', 'union'))
	                    ->values(array($_POST['name'], $_POST['shortname'], $_POST['union']))
                        ->execute();
		        $_SESSION['messages']['success'][] = 'Successfully added '.$_POST['name'].' to groups';
	        } else {
		        $q = DB::update('group')
		                    ->set(array(
		                            'name' => $_POST['name'],
		                            'shortname' => $_POST['shortname'],
		                            'union' => $_POST['union']
		                    ))
		                    ->where('id', '=', $_POST['groupid'])
		                    ->execute();
		        $_SESSION['messages']['success'][] = 'Successfully updated groupdetails';
	        }
	    }
        $group = DB::select('*')->from('group')->where('id','=',$id)->execute();

        $homeroom = DB::select('*')
                    ->from('lt_HomeroomGroup')
                    ->where('group', '=', $id)
                    ->join('homeroom')
                    ->on('homeroom.homeroom_id', '=', 'lt_HomeroomGroup.homeroom')
                    ->execute()
                    ->as_array();

	    $this->content = View::factory('admin/user/groupDetail');
	    $this->css[] = '/css/form.css';
	    $this->js[] = '/js/admin/groupDetail.js';
	    $this->content->homeroom = $homeroom;
	    $this->content->group = $group[0];

	    $this->content->unions = array();
	    foreach(user::get_unions() as $u)
	        $this->content->unions[$u['union_id']] = $u['name'];

	    $this->content->groupId = $id;
	    $members = DB::select('u.fname', 'u.lname','u.user_id', 'ltug.year', array('mt.name', 'membertype'))
	                ->from(array('lt_UserGroup', 'ltug'))
	                ->where('ltug.groupid','=',$id)
	                ->join(array('user', 'u'))
	                ->on('ltug.userid','=','u.user_id')
	                ->join(array('membertype', 'mt'))
	                ->on('ltug.type','=','mt.id')
	                ->order_by('u.lname')
	                ->execute()->as_array();
        $this->content->members = $members;
	}
	public function action_addToGroup(){
	    if(isset($_POST['userids']))
    	    user::add_user_to_group($_POST['userids'], $_POST['groupSelect'], $_POST['membershiptypeSelect']);
        $this->request->redirect($_SERVER['HTTP_REFERER']);
	}
    public function action_addGroupHomeroom(){
        list($count) = DB::select(DB::expr('count(1) as c'))
            ->from('lt_HomeroomGroup')
            ->where('homeroom', '=', $_POST['homeroom'])
            ->and_where('group', '=', $_POST['groupId'])
            ->and_where('year', '=', date('Y'))
            ->execute()
            ->as_array();
        if($count['c'] == 0){
    	    DB::insert('lt_HomeroomGroup', array('homeroom', 'group', 'year'))
	            ->values(array(
	                $_POST['homeroom'],
	                $_POST['groupId'],
	                date('Y')
	            ))
	            ->execute();
        }
	    $this->request->redirect('/admin/user/editGroup/'.$_POST['groupId']);
	}
	public function action_removeHomeroomGroup($group_id, $homeroom, $year){
	    DB::delete('lt_HomeroomGroup')
	        ->where('homeroom', '=', $homeroom)
            ->and_where('group', '=', $group_id)
            ->and_where('year', '=', $year)
            ->execute();
	    $this->request->redirect('/admin/user/editGroup/'.$group_id);
	}

	public function action_removeFromGroup($user_id, $group_id){
	    user::removeUserFromGroup($user_id, $group_id);
	    $this->request->redirect($_SERVER['HTTP_REFERER']);
	}
	public function action_addToMission(){
	    $insert = DB::insert('lt_UserMission', array('userid', 'missionid'))->ignore(true);
	    foreach($_POST['userids'] as $id){
	        $insert->values(array('userid'=>$id, 'missionid' => $_POST['missionSelect']));
	    }
	    $insert->execute();
        $_SESSION['messages']['success'][] = 'User(s) added to mission';
	    $this->request->redirect($_SERVER['HTTP_REFERER']);

	}

}




?>