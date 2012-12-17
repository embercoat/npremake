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
//	    $query = DB::insert('group', array('name'))->values(array('name' => 'hello'))->values(array('name' => 'stuff'));
//	    echo $query;
	}

} // End Welcome
