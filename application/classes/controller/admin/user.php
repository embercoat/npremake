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
		$this->js[] = '/js/jquery.js';
		$this->js[] = '/js/datatables/media/js/jquery.dataTables.js';
		$this->js[] = '/js/admin/mainUser.js';

		$this->css[] = '/js/datatables/media/css/demo_page.css';
		$this->css[] = '/js/datatables/media/css/demo_table.css';
		
		$this->content->users = DB::select('user_id', 'username','fname','lname')
		                            ->from('user')
		                            ->order_by(DB::Expr('lname, fname'))
		                            ->execute()
		                            ->as_array();
	}
	public function action_editUser($userId = NULL){
	    if(is_null($userId)){
	        $_SESSION['messages']['fail'][] = 'Du måste ange ett Id';
	        $this->request->redirect('/admin/user/');
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
	    
	}
	public function action_group(){
        $groups = DB::select('*')->from('group')->order_by('name')->execute();
        $this->content = View::factory('groupList');
	    $this->content->groups = $groups;
	}
	public function action_editGroup($id){
	    if(isset($_POST) && !empty($_POST) && $_SESSION['user']->isAdmin()){
	        $q = DB::update('group')->set(array('name' => $_POST['name']))->where('id', '=', $id)->execute();
	    }
        $group = DB::select('*')->from('group')->where('id','=',$id)->execute();
	    $this->content = View::factory('admin/user/groupDetail');
	    $this->content->group = $group[0];
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
	    user::add_user_to_group($_POST['userids'], $_POST['groupSelect'], $_POST['membershiptypeSelect']);
        $this->request->redirect('/admin/user/');
	    
	}
	public function action_removeFromGroup($user_id, $group_id){
	    user::removeUserFromGroup($user_id, $group_id);
//	    $this->request->redirect('/admin/user/');
   //hellp
	}
	
}
			



?>