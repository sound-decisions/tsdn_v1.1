<?php

class Contact_messages_model extends MY_Model {

	const DB_TABLE = 'contact_messages';
	const DB_TABLE_PK = 'id';


	/**
 	 * Unique identifier.
 	 * var int
	 */
	public $id;

	/**
 	 * Unique identifier for the signed in member (if there is one).
 	 * var int
	 */
	public $member_id;	

	/**
 	 * The name of the person who sent the message.
 	 * var string
	 */
	public $name;	

	/**
 	 * The email address of the person who sent the message.
 	 * var string
	 */
	public $email;	

	/**
 	 * The message that the person sent.
 	 * var string
	 */
	public $message;			

	/**
 	 * The status of the record.
 	 * var string
	 */
	public $status;
	
	/**
 	 * Site notes on the message.
 	 * var string
	 */
	public $notes;	

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
 	 * Get contact messages from DB and return as an array.
 	 * string $status
	 */
	public function get_contact_messages($limit = 20, $status = '') {

		$this->db->from('contact_messages');
		if ($status != '') {
			$this->db->where('status', $status);	
		}		
		$this->db->order_by("created_at", "desc"); 
		$this->db->limit($limit);
		$query = $this->db->get();
		
		return $query->result_array();	

	} // end of - function get_contact_messages



	/**
 	 * Clear the search criteria session variables.
	 */
    public function clear_search_session_variables() {

        $this->session->set_userdata('contact_message_name_search', '');
        $this->session->set_userdata('contact_message_message_search', '');
        $this->session->set_userdata('contact_message_notes_search', '');
		$this->session->set_userdata('contact_message_status_search', '');
        $this->session->set_userdata('contact_message_sql', '');

    } // end of - function clear_search_session_variables	
	
	
	
	
	/**
 	 * Get and return search results.
	 */	
    public function get_contact_messages_search_results() {
        
        $sql = '';
        
        // Get search form values.
        $name_search = $this->input->post('name_search');
		$message_search = $this->input->post('message_search');
		$notes_search = $this->input->post('notes_search');
        $status_search = $this->input->post('status_search');
        
        $this->session->set_userdata('contact_message_name_search', $name_search);
		$this->session->set_userdata('contact_message_message_search', $message_search);
		$this->session->set_userdata('contact_message_notes_search', $notes_search);
        $this->session->set_userdata('contact_message_status_search', $status_search);        
        
        
       
        if (($name_search != '') || ($message_search != '') || ($notes_search != '') || ($status_search != '')) {

           $this->session->set_userdata('contact_message_sql', '');

			$no_search_criteria_entered = false;
        } else {
        	$no_search_criteria_entered = true;
        }
        
		
		// If no search criteris is entered then return an empty array.
		if ($no_search_criteria_entered) {
			$a_contact_messages = array();
			return $a_contact_messages;
		}		    
        
        
        // If there is no value in the variable sql, create the sql statement.
        if ($sql == '') {
            
            $sql = 'SELECT * ' . 
                    'FROM contact_messages ';

            // Add the where clause.
            $sql .= 'WHERE 1 = 1 ';


            if ($name_search != '') {
                $sql .= 'AND name LIKE "%' . $name_search . '%" ';
            } 		

            if ($message_search != '') {
                $sql .= 'AND message LIKE "%' . $message_search . '%" ';
            } 			

            if ($notes_search != '') {
                $sql .= 'AND notes LIKE "%' . $notes_search . '%" ';
            } 			


            if ($status_search != '') {
                $sql .= 'AND status = "' . $status_search . '" ';
            }                    

            $sql .= 'ORDER BY created_at desc ';

            // Save the SQL in a Session Variable.          
            $this->session->set_userdata('contact_message_sql', $sql);
                          
        }
            
        $query = $this->db->query($sql);
        return $query->result_array();

    } // end of - function get_contact_messages_search_results 


} // end of - class 

/* End of file contact_messages_model.php */
/* Location: ./application/models/contact_messages_model.php */