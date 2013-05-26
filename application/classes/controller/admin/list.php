<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Admin_list extends SuperAdminController{
	function before(){
/*        if(!isset($_SESSION['user']) || !$_SESSION['user']->isAdmin()){
			$this->request->redirect('/');
		}
        $this->mainView = View::factory('admin/mainAdmin');*/
	    parent::before();
        $this->noheader = true;

        $this->heads = array(
                'username' => 'Användarnamn',
                'fname' => 'Förnamn',
                'lname' => 'Efternamn',
                'phone' => 'Telefon',
                'adress' => 'Adress',
                'zipcode' => 'Postnummer',
                'city' => 'Postort',
                'allergies' => 'Alleriger',
                'email' => 'Epost',
                'karworker' => 'STUKarbetare',
                'driverlicens' => 'Körkort',
                'program' => 'Program',
                'socialsecuritynumber' => 'Personnummer',
                'cardnumber' => 'Passerkortsnummer',
                'union' => 'Kårtillhörighet',
                'groupname' => 'Grupp'
        );


	}

	function store($query){
	    $serial = serialize($query);
	    DB::insert('list_store', array('hash', 'query'))->values(array(md5($serial), $serial))->execute();
	    return md5($serial);
	}

	function get($hash){
	    $r = DB::select('query')->from('list_store')->where('hash', '=', $hash)->execute()->as_array();
	    return $r[0]['query'];
	}

	function after(){
        if(!empty($this->headers)){
            foreach($this->headers as $key => $value){
                $this->response->headers($key, $value);
            }
        }
        parent::after();
	} //Keeps the supercontroller from doing anything stupid

	public function action_index(){
	    $this->noheader = false;
		$this->content = View::Factory('admin/list/welcome');
		$this->content->checkboxes = $this->heads;
	}

	public function action_gen(){
	    $this->noheader = false;

        if(array_search('groupname', $_POST['sel']) !== FALSE){
            $_POST['sel'][array_search('groupname', $_POST['sel'])] = array('group.name', 'groupname');
            $this->groupsel = true;
        }
	    $query = DB::select_array($_POST['sel'])->from('user');

	    if(isset($_POST['cond']['isPhosare'])){
	        $query->or_where('user.user_id', 'IN',
	                DB::select('userid')->from('lt_UserGroup')->where('year', '=', date('Y'))->where('type', '=', '2')
	        );
	    }
	    if(isset($_POST['cond']['isCPh'])){
	        $query->or_where('user.user_id', 'IN',
	                DB::select('userid')->from('lt_UserGroup')->where('year', '=', date('Y'))->where('type', '=', '3')
	        );
	    }
	    if(isset($_POST['cond']['isNPG'])){
	        $query->or_where('user.user_id', 'IN',
	                DB::select('userid')->from('lt_UserGroup')->where('year', '=', date('Y'))->where('type', '=', '1')
	        );
	    }
	    if(isset($_POST['cond']['isNotChosen'])){
	        $query->or_where('user.user_id', 'IN',
	                DB::select('userid')->from('lt_UserGroup')->where('year', '=', date('Y'))->where('type', '=', '4')
	        );
	    }
        if(isset($this->groupsel)){
            $query->join('lt_UserGroup')->on('user.user_id', '=', 'lt_UserGroup.userid');
            $query->join('group')->on('lt_UserGroup.groupid', '=', 'group.id');
        }
        $this->content = View::Factory('list');
	    $this->content->list_heads = array();
	    foreach($_POST['sel'] as $key) {
	        if(is_array($key)){
	            $nkey = array_pop($key);
	            $this->content->list_heads[$nkey] = $this->heads[$nkey];
	        } else
	         $this->content->list_heads[$key] = $this->heads[$key];
	    }
	    $this->content->list = array();
		$this->content->list = $query->execute()->as_array();

		$head = View::factory('admin/list/show');
		$head->hash = $this->store($query);
		$this->content = $head.$this->content;

	}
    public function action_download($hash){
        $query = unserialize($this->get($hash));

        require Kohana::find_file('vendor', 'ods');
        $ods = ods::newODS();

        $list = $query->execute()->as_array();

        $keys = array_keys($list[0]);

        foreach($keys as $x => $k)
            $ods->addCell('Blad 0',0,$x,$this->heads[$k],'string','bold');
        foreach($list as $y => $l){
            foreach($keys as $x => $k)
                $ods->addCell('Blad 0', $y+1, $x, $l[$k], 'string');
        }

        $ods->set_column_width(0, 10);


        $ods->saveOds(DOCROOT.'tmp/'.$hash.'.ods'); //save the object to a ods file; //save the object to a ods file

        $this->headers['Content-Disposition'] = 'attachment; filename="custom.ods"';
        $this->contenttype = 'application/vnd.oasis.opendocument.spreadsheet';
        $this->headers['Content-Type'] = $this->contenttype;

        $this->content = file_get_contents(DOCROOT.'tmp/'.$hash.'.ods');
        unlink(DOCROOT.'tmp/'.$hash.'.ods');
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
	public function action_stuklist(){
	    require Kohana::find_file('vendor', 'ods');
	    $ods = ods::newODS();

	    $ods->addCell('Stuklista',0,0,'Stuklista','string','bold');
	    $ods->addCell('Stuklista',1,0,'','string');
	    $ods->set_column_width(0, 10);

	    $row_counter = 2;

	    $sql = DB::select('*')
	    ->from('user')
	    ->where('karworker', '<>', '')
	    ->order_by('lname', 'ASC')
	    ->order_by('fname', 'ASC')
	    ->where('user_id', 'IN', DB::select('userid')
	            ->from('lt_UserGroup')
	            ->where('year', '=', date('Y'))
	    );
	    $result = $sql->execute()
	    ->as_array();
	    foreach($result as $r){
	        $ods->addCell('Stuklista',$row_counter,0,$r['lname'].', '.$r['fname'],'string');
	        $ods->addCell('Stuklista',$row_counter++,1,$r['karworker'],'string');
	    }

	    $ods->saveOds(DOCROOT.'tmp/stuklist.ods'); //save the object to a ods file; //save the object to a ods file

	    $this->headers['Content-Disposition'] = 'attachment; filename="stuklist.ods"';
	    $this->contenttype = 'application/vnd.oasis.opendocument.spreadsheet';
	    $this->headers['Content-Type'] = $this->contenttype;

	    $this->content = file_get_contents(DOCROOT.'tmp/stuklist.ods');
	    unlink(DOCROOT.'tmp/stuklist.ods');
	}
	public function action_setup(){

	}
}




?>