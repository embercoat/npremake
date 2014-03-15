<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Test extends SuperController {
    function before(){
        parent::before();

    }

	public function action_index()
	{
	    $group_id = '1';
	    Model::factory('hook')->execute('user_group_change', $group_id);
	}

} // End Welcome
