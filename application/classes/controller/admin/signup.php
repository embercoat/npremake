<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_signup extends SuperAdminController{
	function before(){
        parent::before();
	}
	public function action_index(){
		$this->content = View::Factory('admin/signup/welcome');
		$this->content->lists = Model::factory('list')->get_lists();
	}
	public function action_list($list){
	    if(isset($_POST) && !empty($_POST)){
	        $_POST['require_moderation'] = isset($_POST['require_moderation']) ? true : false;
	        $_POST['visible'] = isset($_POST['visible']) ? true : false;
	        $_POST['open'] = isset($_POST['open']) ? true : false;
	        Model::factory('list')->update($list, $_POST['name'], $_POST['description'], $_POST['visible'], $_POST['open'], $_POST['require_moderation']);
	    }
	    $this->css[] = '/css/form.css';
	    $this->content = View::Factory('admin/signup/show');
	    $this->content->list = Model::factory('list')->get_list($list);
	    $this->content->create = false;
	}
	public function action_deleteList($id){
	    Model::factory('list')->delete_list($id);
	    $this->request->redirect('/admin/signup');
	}
	public function action_create(){
	    $this->css[] = '/css/form.css';
	    $this->content = View::Factory('admin/signup/show');
	    if(isset($_POST) && !empty($_POST)){
	        $_POST['require_moderation'] = isset($_POST['require_moderation']) ? true : false;
	        $_POST['visible'] = isset($_POST['visible']) ? true : false;
	        $_POST['open'] = isset($_POST['open']) ? true : false;

	        $redirect = Model::factory('list')->create(
	            $_POST['name'],
	            $_POST['description'],
                $_POST['visible'],
                $_POST['open'],
                $_POST['require_moderation']
            );
	        $this->request->redirect('/admin/signup/list/'.$redirect[0]);
	    }
	    $this->content->create = true;
	}
	public function action_participants($list){
	    $this->content = View::factory('admin/signup/participants');
	    $this->content->participants = Model::factory('list')->get_participants($list);
	    $this->content->list = Model::factory('list')->get_list($list);
	}
	public function action_deleteparticipant($userid, $listid){
	    Model::factory('list')->remove_participant($userid, $listid);
	    $this->request->redirect($_SERVER['HTTP_REFERER']);
	}
	public function action_confirmparticipant($userid, $listid){
	    Model::factory('list')->confirm_participant($userid, $listid);
	    $this->request->redirect($_SERVER['HTTP_REFERER']);
	}
	public function action_unconfirmparticipant($userid, $listid){
	    Model::factory('list')->unconfirm_participant($userid, $listid);
	    $this->request->redirect($_SERVER['HTTP_REFERER']);
	}


}




?>