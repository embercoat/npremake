<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Welcome extends SuperController {
    function before(){
        parent::before();
    }

	public function action_index()
	{
	    $this->content = View::factory('news');
	}

} // End Welcome
