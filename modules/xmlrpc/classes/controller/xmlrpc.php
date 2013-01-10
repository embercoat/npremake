<?php defined('SYSPATH') or die('No direct script access.');

class Controller_xmlrpc extends Controller {

	public function action_index()
	{
	    $methods = array();
	    foreach(get_class_methods('rpc') as $methodName){
	        $methods['rpc.'.$methodName] = 'rpc:'.$methodName;
	    }
 	    require Kohana::find_file('vendor', 'IXR_Library', 'php');
 	    $ixr = array(
             'rpc.getTime' => 'rpc:getTime',
         );
 	    $server = new IXR_Server($methods);
	}
}
class rpc {
    public function checkaccess($args){
        $this->session = Session::instance();
    	if($this->session->get('user') === NULL){
    		$this->session->set('user', user::instance());
    	}
        if(!$this->session->get('user')->isAdmin()) {
    		return new IXR_Error(-32601, 'Client error. Not Authorized');
    	} else {
    	    return true;
    	}
    }
    public function autocomplete($args){
        list($type, $string) = $args;
        $sql = DB::select_array(array('user_id', DB::expr('concat(fname, " ", lname) as name')))
                ->from('user')
                ->where(DB::expr('concat(fname, " ", lname)'), 'like', $string.'%');
        return $sql->execute()->as_array();

    }
}
