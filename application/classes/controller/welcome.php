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
	    if(isset($_SESSION['user']) && $_SESSION['user']->logged_in()){
    	    $this->content = View::factory('news');
	    } else {
	        $r = DB::select('content')
	        ->from('dynamic')
	        ->where('page','=','vadarnolleperioden')
	        ->order_by('edited', 'desc')
	        ->limit(1);
	        $r = $r->execute()
	        ->as_array();
	        $this->content = View::factory('dynamic');
	        $this->content->data = $r[0]['content'];
	        $this->content->page = 'vadarnolleperioden';
	    }
	}

} // End Welcome
