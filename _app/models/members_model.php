<?php

class Members_model extends MY_Model {

	const DB_TABLE = 'members';
	const DB_TABLE_PK = 'id';


	/**
 	 * Issue unique identified.
 	 * var int
	 */
	public $id;

	/**
 	 * 
 	 * var string
	 */
	public $first_name;

	/**
 	 * 
 	 * var string
	 */
	public $last_name;	

	/**
 	 * 
 	 * var string
	 */
	public $email;

	/**
 	 * 
 	 * var string
	 */
	public $password;

	/**
 	 * 
 	 * var string
	 */
	public $encrypted_password;

	/**
 	 * 
 	 * var string
	 */
	public $city;				

	/**
 	 * 
 	 * var string
	 */
	public $province;

	/**
 	 * 
 	 * var string
	 */
	public $country;

	/**
 	 * 
 	 * var string
	 */
	public $gender;	

	/**
 	 * 
 	 * var date
	 */
	public $date_of_birth;			

	/**
 	 * 
 	 * var string
	 */
	public $profile_photo;

	/**
 	 * 
 	 * var string
	 */
	public $profile_photo_tn;	

	/**
 	 * 
 	 * var string
	 */
	public $email_confirmed;	

	/**
 	 * 
 	 * var int
	 */
	public $sign_in_count;

	/**
 	 * 
 	 * var datetime
	 */
	public $current_sign_in_at;

	/**
 	 * 
 	 * var datetime
	 */
	public $last_sign_in_at;

	/**
 	 * Should this record be displayed or not.
 	 * var string
	 */
	public $display;	

	/**
 	 * Is this a featured record.
 	 * var string
	 */
	public $featured;			

	/**
 	 * The status of the record.
 	 * var string
	 */
	public $status;

	/**
 	 * The access level for the member.
 	 * var string
	 */
	public $access;

	/**
 	 * Role is used to differentiate between various people who use the site.
 	 * var string
	 */
	public $role;

	/**
 	 * Membership level is used to determin access and stop advertising from being displayed.
 	 * var string
	 */
	public $membership_level;	

	/**
 	 * The date and time the record was created.
 	 * var datetime
	 */
	public $created_at;	

	/**
 	 * The date and time the record was last updated.
 	 * var datetime
	 */
	public $updated_at;		




	/**
 	 * Get members from the DB and return them as an array.
	 */
	public function get_members($limit = 10) {

		$this->db->from('members');
		$this->db->order_by("created_at", "desc");
		$this->db->order_by("first_name", "asc"); 
		$this->db->order_by("last_name", "asc"); 
		$this->db->limit($limit);
		$query = $this->db->get();		
		
		return $query->result_array();	

	} // end of - function get_members
	


	/**
 	 * Clear the search criteria session variables.
	 */
    public function clear_search_session_variables() {

        $this->session->set_userdata('member_starts_with_search', '');
        $this->session->set_userdata('member_name_search', '');
        $this->session->set_userdata('member_status_search', '');
        $this->session->set_userdata('member_access_rating_search', '');
        $this->session->set_userdata('member_search_sql', '');

    } // end of - function clear_search_session_variables	
	
	
	
	
	/**
 	 * Get and return search results.
	 */	
    public function get_member_search_results() {
        
        $sql = '';
        
        // Get search form values.
        $starts_with = $this->input->post('starts_with');
        $name_search = $this->input->post('name_search');
        $status_search = $this->input->post('status_search');
        $access_search = $this->input->post('access_search');
        
        $this->session->set_userdata('member_starts_with_search', $starts_with);
        $this->session->set_userdata('member_name_search', $name_search);
        $this->session->set_userdata('member_status_search', $status_search);
        $this->session->set_userdata('member_access_search', $access_search);
        
        
       
        if (($starts_with != '') || ($name_search != '') || ($status_search != '') || ($access_search != '')) {

           $this->session->set_userdata('member_search_sql', '');

			$no_search_criteria_entered = false;
        } else {
        	$no_search_criteria_entered = true;
        }
        
		
		// If no search criteris is entered then return an empty array.
		if ($no_search_criteria_entered) {
			$a_members = array();
			return $a_members;
		}		    
        
        
        // If there is no value in the variable sql, create the sql statement.
        if ($sql == '') {
            
            $sql = 'SELECT * ' . 
                    'FROM members ';

            // Add the where clause.
            $sql .= 'WHERE 1 = 1 ';

            if ($starts_with != '') {
                $sql .= 'AND ((first_name LIKE "' . $starts_with . '%") OR (last_name LIKE "' . $starts_with . '%")) ';
            }

            if ($name_search != '') {
                $sql .= 'AND ((first_name LIKE "%' . $name_search . '%") OR (last_name LIKE "%' . $name_search . '%")) ';
            } 			

            if ($status_search != '') {
                $sql .= 'AND status = "' . $status_search . '" ';
            }            

            if ($access_search != '') {
                $sql .= 'AND access = "' . $access_search . '" ';
            }          

            $sql .= 'ORDER BY first_name, last_name ';

            // Save the SQL in a Session Variable.          
            $this->session->set_userdata('member_search_sql', $sql);
                          
        }
            
        $query = $this->db->query($sql);
        return $query->result_array();

    } // end of - function get_member_search_results 



	/**
 	 * Sign a member in using the email and encrypted_password provided.
 	 * @param email string
 	 * @param encrypted_password string
	 */
	public function member_sign_in($email, $encrypted_password) {

		$this->db->from('members');
		$this->db->where('email', $email);
		$this->db->where('encrypted_password', $encrypted_password); 
		$query = $this->db->get();
		
		return $query->row();

	} // end of - function member_sign_in



	/**
 	 * Check to see if a member record exists with the values provided.
 	 * @param first_name string
 	 * @param last_name string
 	 * @param email string
	 */
	public function does_member_exits($first_name, $last_name, $email) {

		$this->db->select('id');
		$this->db->from('members');
		$this->db->where('first_name', $first_name);
		$this->db->where('last_name', $last_name);
		$this->db->where('email', $email);
		$query = $this->db->get();
		
		return $query->row();

	} // end of - function does_member_exits	



	/**
 	 * Check to see if the email address entered is already being used.
 	 * @param email string
	 */
	public function is_email_being_used($email) {

		$this->db->select('id, email');
		$this->db->from('members');
		$this->db->where('email', $email);
		$query = $this->db->get();
		
		return $query->row();

	} // end of - function is_email_being_used


} // end of - class 

/* End of file members_model.php */
/* Location: ./application/models/members_model.php */