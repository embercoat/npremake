<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_Document extends SuperAdminController {
    function before(){
        parent::before();
        
    }
    
	public function action_index()
	{
	    $documents = DB::select('*')
	                    ->from('document')
	                    ->order_by('name', 'ASC')
	                    ->execute()
	                    ->as_array();
	    $this->content = View::factory('admin/document/main');
	    $this->content->documents = $documents;   
	}
	public function action_add(){
	    $this->css[] = '/css/form.css';
	    $this->content = View::factory('admin/document/addForm');
	}
	public function action_del($document_id){
	    list($filename) = DB::select('filename')
	                    ->from('document')
	                    ->where('id', '=', $document_id)
	                    ->execute()
	                    ->as_array();
        unlink(APPPATH.'upload/documents/'.$filename['filename']);
	    DB::delete('document')
	        ->where('document.id','=', $document_id)
	        ->execute();
        $_SESSION['messages']['success'][] = 'Filen har tagits bort från servern';
        $this->request->redirect('/admin/document/');
	}
	public function action_edit($document_id){
	    if(isset($_POST['name'])){
	        unset($_POST['submit']);
	        if(!isset($_POST['requirePhosare']))
	            $_POST['requirePhosare'] = 0;
	        if(!isset($_POST['requireLogin']))
	            $_POST['requireLogin'] = 0;
	        if(!isset($_POST['requireAdmin']))
	            $_POST['requireAdmin'] = 0;
	            
	            DB::update('document')
	            ->set($_POST)
	            ->execute();
	    }
	    $this->css[] = '/css/form.css';
        list($document) = DB::select('*')
	                        ->from('document')
	                        ->where('document.id', '=', $document_id)
	                        ->execute()
	                        ->as_array();
        $this->content = View::factory('admin/document/editForm');
        $this->content->document = $document;
        $this->content->document_id = $document_id;
	}
	public function action_upload(){
	    if(Upload::not_empty($_FILES['file'])){
		    $parts = explode('.', $_FILES['file']['name']);
		    $_POST['filename'] = md5_file($_FILES['file']['tmp_name']).'.'.array_pop($parts);
		    $ul = Upload::save($_FILES['file'], $_POST['filename'], APPPATH.'upload/documents/');
		    unset($_POST['submit']);
		    $_POST['datetime'] = time();
		    $_POST['original_filename'] = $_FILES['file']['name'];
		    $id = DB::insert('document', array_keys($_POST))
		            ->values($_POST)
		            ->execute();
            $_SESSION['messages']['success'][] = 'Filen laddades upp och lades till i databasen';
            $this->request->redirect('/admin/document/edit/'.$id[0]);
	    } else {
	        $_SESSION['messages']['fail'][] = 'Något gick fel. Försök igen.';
	    }
	}

} // End Welcome
