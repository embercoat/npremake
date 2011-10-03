<?php
/**
 * 
 * @author draco
 * This is the supercontroller that all the other controllers inherit from.
 * Contains the things that are common for all the controllers
 *
 */
class SuperController extends Kohana_Controller {
    protected $mainView;
    protected $db;
    protected $user;
    protected $content;
    private $starttime;
    private $stats = array();
    protected $css = array();
	protected $js = array();
	protected $render = true;
	/**
	 * This function is run before the controller. 
	 * Useful for preparing the environment
	 * 
	 */
    public function before(){
        $this->mainView = View::factory('main');
    }
    /**
     * Runs after everything else.
     * Used here to render the menu and then send the collected response to the client
     */
    public function after(){
        $this->mainView->menu = View::factory('menu');
        $this->mainView->content = $this->content;

        $this->stats['time'] = $this->starttime;
        $this->mainView->stats = $this->stats;
        
        $this->mainView->css = $this->css;
        $this->mainView->js = $this->js;
        if($this->render)
            $this->response->body($this->mainView);
    }

}

?>