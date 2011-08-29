<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Dynamic extends SuperController {
    function before(){
        parent::before();
        $this->css[] = '/css/dynamic.css';
    }
    
	public function action_index($page = null, $edit = false)
	{
	    if($page == null){
	        $this->request->redirect('/');
	    }
	    if($edit !== false && isset($_SESSION['user']) && $_SESSION['user']->isAdmin()){
	        if(isset($_POST['ckedit'])){
	            $query = DB::insert('dynamic', array('content', 'page','edited', 'edited_by'))
	            ->values(array($_POST['ckedit'], $page, time(), $_SESSION['user']->getId()));
	            $query->execute();
	        }
	        $this->content = View::factory('ckedit');
	        $this->content->action = '/dynamic/'.$page.'/edit';
            $r = DB::select('content')
		        ->from('dynamic')
		        ->where('page','=',$page)
		        ->order_by('edited', 'desc')
		        ->limit(1)
		        ->execute();
		    if($r->count() > 0){
		        $this->content->data = $r[0]['content'];    
		    } else {
		        $this->content->data = '';
		    }
	    } else { 
		    $r = DB::select('content')
		        ->from('dynamic')
		        ->where('page','=',$page)
		        ->order_by('edited', 'desc')
		        ->limit(1);
		    $r = $r->execute()
		        ->as_array();
		    if(count($r) > 0){
	    	    $this->content = View::factory('dynamic'); 
	    	    $this->content->data = $r[0]['content'];
	    	    $this->content->page = $page;
		    } else {
		        $this->content ="This page does not exist.";
		        if(isset($_SESSION['user']) && $_SESSION['user']->isAdmin()){
		            $this->content .= ' <a href="/dynamic/'.$page.'/edit">Would you like to add it?</a>';   
		        }
		    }
	    }
	}
} // End Welcome
