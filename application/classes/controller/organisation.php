<?php defined('SYSPATH') or die('No direct script access.');
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class Controller_Organisation extends SuperController {
    function before(){
        parent::before();
    }

	public function action_index()
	{
	    $this->content = View::factory('listOrganisations');
	    $this->content->organisations =
	            DB::select_array(array('*', array('organisation_type.type', 'organisation_type'), array( 'organisation.id' , 'organisation_id')))
	                ->from('organisation')
	                ->join('organisation_type')
	                ->on('organisation.type', '=', 'organisation_type.id')
	                ->order_by('name', 'asc')
	                ->execute()
	                ->as_array();
	}
	public function action_Details($organisation_id){
	    $this->content = View::factory('organisationDetails');
	    $sql = DB::select('*')
                ->from('organisation')
                ->join('organisation_type')
                ->on('organisation.type', '=', 'organisation_type.id')
                ->where('organisation.id', '=', $organisation_id);
        list($this->content->details) = $sql->execute()->as_array();

        $this->content->members =
                    DB::select_array(array('lt_UserOrganisation.*', 'user.fname', 'user.lname'))
                        ->from('lt_UserOrganisation')
                        ->join('user')
                        ->on('lt_UserOrganisation.userid', '=', 'user.user_id')
                        ->execute()
                        ->as_array();
		}

} // End Welcome
