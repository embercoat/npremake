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
	        if($_POST['applicationid'] == 'new'){
    	        DB::insert('applicant', array('userid', 'timestamp', 'whyphosa','phosbuddy', 'cph', 'program','klass', 'importantMe', 'phosHistory', 'phosHistoryBox','studentikosa', 'union'))
    	                ->values(
    	                    array(
    	                    	$_SESSION['user']->getId(),
    	                    	DB::expr('unix_timestamp()'),
    	                    	$_POST['whyphosa'],
								$_POST['phosbuddy'],
    	                        $_POST['cph'],
    	                        $_POST['program']
								
								
								
    	                    )
    	                 )
    	                 ->execute();
    	        $_SESSION['message']['success'][] = 'Du har nu anmält ditt intresse att phösa';
	        } else {
	            $sql = DB::update('applicant')
	                ->where('id', '=', $_POST['applicationid']);
	            unset($_POST['submit'], $_POST['applicationid']);
	            $sql->set($_POST)
	                ->execute();
	            $_SESSION['message']['success'][] = 'Du har nu uppdaterat din ansökan';
	        }
	        $this->content->justApplied = true;
	    }

	    $critical_fields = unserialize(Model::factory('store')->get_value('phosarapplication_required_fields'));
	    $all_good = true;

        $user_data = $_SESSION['user']->get_current_user_data();
	    foreach($critical_fields as $cf){
	        if(empty($user_data[$cf])){
	            $all_good = false;
	        }
	    }

	    $this->content->all_good = $all_good;
	    $this->content->application = user::instance()->getApplication($_SESSION['user']->getId());
	}

} // End Welcome
