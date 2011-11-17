<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_News extends SuperAdminController {

	public function action_index()
	{
		$this->content = View::factory('admin/news/list');
	}
	public function action_edit($id = 'new')
	{
		if(isset($_POST) && !empty($_POST))
		{
			if(is_numeric($id))
				Model::factory('news')->update_by_id($id, $_POST['title'], $_POST['text'], Session::instance()->get('user')->getId());
			else 
				$id = Model::factory('news')->create($_POST['title'], $_POST['text'], $_SESSION['user']->getId(), time());
				$this->request->redirect('/admin/news/edit/'.$id);
		}
		$this->content = View::factory('admin/news/edit');
		if($id !== 'new')
		{
			$this->content->details = Model::factory('news')->get_details($id);
		}
	}
	public function action_delete($id){
		Model::factory('news')->delete($id);
		$this->request->redirect('/admin/news/');
	}

} // End Welcome
