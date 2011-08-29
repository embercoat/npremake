<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_overalls extends SuperController {
    function before(){
        parent::before();
        
    }
    
	public function action_index()
	{
	    $this->content = 'sidan finns inte än';
	}

} // End Welcome
