<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 * This is the supercontroller that all the other controllers inherit from.
 * Contains the things that are common for all the controllers
 *
 */
class SuperAdminController extends Kohana_Controller {
    protected $mainView;
    protected $db;
    protected $user;
    protected $content;
    protected $js = array();
    protected $css = array();
    protected $custom_head = array();
    private $starttime;
    private $stats = array();
    protected $noheader = false;
	/**
	 * This function is run before the controller.
	 * Useful for preparing the environment
	 *
	 */
    public function before(){
        if(!isset($_SESSION['user']) || !$_SESSION['user']->isAdmin()){
			$this->request->redirect('/');
		}
        $this->mainView = View::factory('admin/mainAdmin');
    }
    /**
     * Runs after everything else.
     * Used here to render the menu and then send the collected response to the client
     */
    public function after(){
        if(isset($_SESSION['messages'])){
            $this->mainView->messages = $_SESSION['messages'];
            unset($_SESSION['messages']);
        }
        if($this->noheader === false){
            $this->mainView->content = $this->content;
            $this->mainView->css = $this->css;
            $this->mainView->custom_head = $this->custom_head;
            $this->mainView->js = $this->js;
            $this->response->body($this->mainView);
        } else {
            $this->response->body($this->content);
        }
    }

}

?>