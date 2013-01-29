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
	    $this->content = View::factory('apply/phosare');
	    $this->content->justApplied = false;
	    if(isset($_POST['whyphosa']) && ! empty($_POST['whyphosa'])){
	        $_POST['cph'] = (isset($_POST['cph']) ? 1 : 0);
	        DB::insert('applicant', array('userid', 'timestamp', 'whyphosa', 'cph', 'program'))
	                ->values(
	                    array(
	                    	$_SESSION['user']->getId(),
	                    	DB::expr('unix_timestamp()'),
	                    	$_POST['whyphosa'],
	                        $_POST['cph'],
	                        $_POST['programId']
	                    )
	                 )
	                 ->execute();
	        $_SESSION['message']['success'][] = 'Du har nu anmält ditt intresse att phösa';
	        $this->content->justApplied = true;
	    }
	    $this->content->application = user::instance()->getApplication($_SESSION['user']->getId());
	}

} // End Welcome
