<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_document extends SuperController {
    function before(){
        parent::before();
        
    }
    
	public function action_index()
	{
	    $documents = DB::select('*')
	        ->from('document')
	        ->where(DB::Expr('from_unixtime(datetime, "%Y")'), 'in', 
	            DB::Expr('('.DB::select('year')->from('lt_UserGroup')->where('userid', '=', $_SESSION['user']->getId()).')'))
	        ->where('requireAdmin', 'in', DB::Expr((($_SESSION['user']->isAdmin()) ? '(0,1)': '(0)')))
	        ->execute()
	        ->as_array();
        $this->content = View::factory('documents');
        $this->content->documents = $documents;
	}
	public function action_download($document_id){
	    list($document) = DB::select('*')
	                    ->from('document')
	                    ->where('id', '=', $document_id)
	                    ->execute()
	                    ->as_array();
        $full_path = APPPATH.'upload/documents/'.$document['filename'];
        $parts = explode('.', $document['filename']);
//        var_dump(File::mime_by_ext(array_pop($parts)));
	    $fs = filesize($full_path);
	    $this->render = false;
        header('Content-type: '.File::mime_by_ext(array_pop($parts)));
        header('Content-Disposition: attachment; filename="'.$document['original_filename'].'"');
        header('Content-length: '.$fs);
        echo file_get_contents($full_path);
        
	}

} // End Welcome
