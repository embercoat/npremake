<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_list extends SuperAdminController{
	function before(){
        if(!isset($_SESSION['user']) || !$_SESSION['user']->isAdmin()){
			$this->request->redirect('/');
		}
        $this->mainView = View::factory('admin/mainAdmin');
	}
	function after(){
        if(!empty($this->headers)){
            foreach($this->headers as $key => $value){
                $this->response->headers($key, $value);
            }
        }

        $this->response->body($this->content);
	} //Keeps the supercontroller from doing anything stupid

	public function action_index(){
		$this->content = View::Factory('admin/list/welcome');
	}
	public function action_allergy(){
	    require Kohana::find_file('vendor', 'ods');
        $ods = ods::newODS();

        $ods->addCell('Allergilista',0,0,'Allergilista','string','bold');
        $ods->addCell('Allergilista',1,0,'','string');
        $ods->set_column_width(0, 10);

        $row_counter = 2;

        $sql = DB::select('*')
                ->from('user')
                ->where('allergies', '<>', '')
                ->order_by('lname', 'ASC')
                ->order_by('fname', 'ASC')
                ->where('user_id', 'IN', DB::select('userid')
                                            ->from('lt_UserGroup')
                                            ->where('year', '=', date('Y'))
                         );
        $result = $sql->execute()
                ->as_array();
        foreach($result as $r){
            $ods->addCell('Allergilista',$row_counter,0,$r['lname'].', '.$r['fname'],'string');
            $ods->addCell('Allergilista',$row_counter++,1,$r['allergies'],'string');
        }

        $ods->saveOds(DOCROOT.'tmp/allergies.ods'); //save the object to a ods file; //save the object to a ods file

        $this->headers['Content-Disposition'] = 'attachment; filename="allergies.ods"';
        $this->contenttype = 'application/vnd.oasis.opendocument.spreadsheet';
        $this->headers['Content-Type'] = $this->contenttype;

//        var_dump($ods->array2ods());

        $this->content = file_get_contents(DOCROOT.'tmp/allergies.ods');
        unlink(DOCROOT.'tmp/allergies.ods');
	}
}




?>