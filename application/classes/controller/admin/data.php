<?php
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_data extends SuperAdminController{
	function before(){
        parent::before();
	}
	public function action_index(){
		$this->content = View::Factory('admin/welcome');
	}
	public function action_program(){
	    $this->js[] = '/js/jquery.js';
	    $this->js[] = '/js/admin/data.js';
	    $programs = DB::select('*')
                        ->from('program')
                        ->order_by('name', 'asc')
                        ->execute()
                        ->as_array();
        $this->content = View::Factory('admin/data/programs');
        $this->content->programs = $programs;
                        
	}
	public function action_delProgram($pid){
	    DB::delete('program')
	        ->where('id', '=', $pid)
	        ->limit(1)
	        ->execute();
	    DB::update('user')
            ->set(array('programId' => 37))
            ->where('programId','=', $pid)
            ->execute();

        $_SESSION['messages']['success'][] = 'Successfully removed pid '.$pid;
	    $this->request->redirect('/admin/data/program');
	}
	public function action_editProgram(){
	    if($_POST['program_id'] !== 'new'){
	        if($_POST['oldname'] == $_POST['newname']){
	            $_SESSION['messages']['warning'][] = 'No difference between new and old name. Not changed.';
	        } else {
		        DB::update('program')
			        ->set(array('name' => $_POST['newname']))
			        ->where('id', '=', $_POST['program_id'])
			        ->execute();
			    $_SESSION['messages']['success'][] = 'Successfully changed <b>'. $_POST['oldname'] .'</b> to <b>'.$_POST['newname'].'</b>';
	        }
	    } else {
	        DB::insert('program', array('name'))
	            ->values(array('name' => $_POST['newname']))
	            ->execute();
            $_SESSION['messages']['success'][] = 'Successfully added <b>'.$_POST['newname'].'</b> to available programs';
	    }
        $this->request->redirect('/admin/data/program');
	        
	}
}
			



?>