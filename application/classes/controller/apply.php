<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_apply extends SuperController {
    function before(){
        parent::before();
        
    }
    
	public function action_index()
	{
	    $this->request->redirect('/');
	}
	
	public function action_phosare(){
	    if(isset($_POST['whyphosa']) && ! empty($_POST['whyphosa'])){
	        DB::insert('applicant', array('userid', 'timestamp', 'whyphosa'))
	                ->values(
	                    array(
	                    	'userid' => $_SESSION['user']->getId(), 
	                    	'timestamp' => DB::expr('unix_timestamp()'), 
	                    	'whyphosa' => $_POST['whyphosa']
	                    )
	                 )
	                 ->execute();
	                
	    }
	    $this->content = View::factory('apply/phosare');
	}

} // End Welcome
