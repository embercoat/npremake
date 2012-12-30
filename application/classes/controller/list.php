<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_list extends SuperController {
    function before(){
        parent::before();
    }

	public function action_index()
	{
	    $this->content = View::factory('list/main');
	    $this->content->lists = Model::factory('list')->get_lists(true);
	}
	public function action_participate($list){
	    if(Model::factory('list')->is_open($list) == 1)
	        Model::factory('list')->add_participant($_SESSION['user']->getId(), $list);
	    $this->request->redirect($_SERVER['HTTP_REFERER']);
	}
	public function action_unparticipate($list){
	    if(Model::factory('list')->is_open($list) == 1)
	        Model::factory('list')->remove_participant($_SESSION['user']->getId(), $list);
	    $this->request->redirect($_SERVER['HTTP_REFERER']);
	}


} // End Welcome
