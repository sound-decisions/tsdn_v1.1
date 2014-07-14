<?php

class Movies_model extends MY_Model {

	const DB_TABLE = 'movies';
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
	public $title;

	/**
 	 * 
 	 * var string
	 */
	public $plot;	

	/**
 	 * 
 	 * var string
	 */
	public $genre;

	/**
 	 * 
 	 * var string
	 */
	public $year_released;

	/**
 	 * 
 	 * var string
	 */
	public $runtime;

	/**
 	 * 
 	 * var string
	 */
	public $mpaa_rating;				

	/**
 	 * 
 	 * var decimal
	 */
	public $overall_rating;

	/**
 	 * 
 	 * var string
	 */
	public $starring;

	/**
 	 * 
 	 * var string
	 */
	public $directed_by;	

	/**
 	 * 
 	 * var string
	 */
	public $written_by;			

	/**
 	 * 
 	 * var string
	 */
	public $produced_by;

	/**
 	 * 
 	 * var string
	 */
	public $image;	

	/**
 	 * 
 	 * var string
	 */
	public $imdb_image_url;	

	/**
 	 * 
 	 * var string
	 */
	public $inventory_owned;	
	
	/**
 	 * 
 	 * var string
	 */
	public $inventory_burned;	
	
	/**
 	 * 
 	 * var string
	 */
	public $inventory_backedup;
	
	/**
 	 * 
 	 * var string
	 */
	public $inventory_downloaded;	
	
	/**
 	 * 
 	 * var string
	 */
	public $imdb_id;
	
							/**
 	 * Indicates if this record should be displayed or not.
 	 * var string
	 */
	public $display;	

	/**
 	 * Indicates if this record is featured or not.
 	 * var string
	 */
	public $featured;	

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
 	 * Get movies details from the DB and return them as an array.
	 */
	public function get_movie_details($id) {

		// If a memeber is signed in then get member_movies data as well.
		if ($this->session->userdata('member_id') != '') {
			
            $sql = 'SELECT m.id, m.title, m.plot, m.genre, m.year_released, m.runtime, m.mpaa_rating, ' . 
            		'm.starring, m.directed_by, m.written_by, m.produced_by, m.image, m.imdb_image_url, m.featured, ' . 
            		'mm.id AS member_movie_id, mm.review_rating, mm.review_text, mm.on_watch_list, mm.seen_it, mm.in_720, mm.in_1080, mm.in_3d ' .
                    'FROM movies AS m LEFT JOIN member_movies AS mm ON m.id = mm.movie_id ' . 
                    'WHERE m.id = ' . $id . ' ';
		} else {

            $sql = 'SELECT id, title, plot, genre, year_released, runtime, mpaa_rating, ' . 
            		'starring, directed_by, written_by, produced_by, image, imdb_image_url, featured ' . 
                    'FROM movies ' . 
                    'WHERE id = ' . $id . ' ';
		}
		
		$query = $this->db->query($sql);
		
		return $query->result_array();

	} // end of - function get_movie_details



	/**
 	 * Get movies from the DB and return them as an array.
	 */
	public function get_movies($limit = 20) {

		// If a memeber is signed in then get member_movies data as well.
		if ($this->session->userdata('member_id') != '') {
			
            $sql = 'SELECT m.id, m.title, m.plot, m.genre, m.year_released, m.runtime, m.mpaa_rating, ' . 
            		'm.starring, m.directed_by, m.written_by, m.produced_by, m.image, m.imdb_image_url, m.featured, ' . 
            		'mm.id AS member_movie_id, mm.on_watch_list, mm.seen_it ' .  
                    'FROM movies AS m LEFT JOIN member_movies AS mm ON m.id = mm.movie_id ' . 
                    'WHERE m.display = "yes" ' .                 
                    'ORDER BY m.created_at DESC, m.title ASC ' . 
					'LIMIT ' . $limit . ' ';
			
			$query = $this->db->query($sql);
			
		} else {

			$this->db->from('movies');
			$this->db->where('display', 'yes');
			$this->db->order_by("created_at", "desc");
			$this->db->order_by("title", "asc");
			$this->db->limit($limit);
			$query = $this->db->get();
			
		}
		
		return $query->result_array();

	} // end of - function get_movies
	
	
	/**
 	 * Get featured movies from the DB and return them as an array.
	 */
	public function get_featured_movies($limit = 200) {

		// If a memeber is signed in then get member_movies data as well.
		if ($this->session->userdata('member_id') != '') {
			
            $sql = 'SELECT m.id, m.title, m.plot, m.genre, m.year_released, m.runtime, m.mpaa_rating, ' . 
            		'm.starring, m.directed_by, m.written_by, m.produced_by, m.image, m.imdb_image_url, m.featured, ' . 
            		'mm.id AS member_movie_id, mm.on_watch_list, mm.seen_it ' .  
                    'FROM movies AS m LEFT JOIN member_movies AS mm ON m.id = mm.movie_id ' . 
                    'WHERE m.display = "yes" ' . 
                    'AND m.featured = "yes" ' . 
                    'AND mm.member_id = ' . $this->session->userdata('member_id') . ' ' . 
                    'ORDER BY m.title asc ' . 
					'LIMIT ' . $limit . ' ';
			
			$query = $this->db->query($sql);

		} else {
			
			$this->db->from('movies');
			$this->db->where('display', 'yes');
			$this->db->where('featured', 'yes');
			//$this->db->order_by("created_at", "desc");
			$this->db->order_by("title", "asc");
			$this->db->limit($limit);
			$query = $this->db->get();
			
		}
		
		return $query->result_array();

	} // end of - function get_featured_movies	
	
	
	
	/**
 	 * Get My Watch List movies from the DB and return them as an array.
	 */
	public function get_my_watch_list_movies($limit = 200) {
		
		// If a memeber is signed in then get member_movies data as well.
		if ($this->session->userdata('member_id') != '') {
			
            $sql = 'SELECT m.id, m.title, m.plot, m.genre, m.year_released, m.runtime, m.mpaa_rating, ' . 
            		'm.starring, m.directed_by, m.written_by, m.produced_by, m.image, m.imdb_image_url, m.featured, ' . 
            		'mm.id AS member_movie_id, mm.on_watch_list, mm.seen_it ' .  
                    'FROM movies AS m LEFT JOIN member_movies AS mm ON m.id = mm.movie_id ' . 
                    'WHERE display = "yes" ' . 
                    'AND on_watch_list = "yes" ' . 
                    'AND mm.member_id = ' . $this->session->userdata('member_id') . ' ' . 
                    'ORDER BY title asc ' . 
					'LIMIT ' . $limit . ' ';
			
			$query = $this->db->query($sql);
			
		} else {
			
			$this->db->from('movies');
			$this->db->where('display', 'yes');
			$this->db->where('featured', 'yes');
			//$this->db->order_by("created_at", "desc");
			$this->db->order_by("title", "asc");
			$this->db->limit($limit);
			$query = $this->db->get();
			
		}
		
		return $query->result_array();

	} // end of - function get_my_watch_list_movies		

	
	
    public function clear_search_session_variables() {

        $this->session->set_userdata('movie_starts_with_search', '');
        $this->session->set_userdata('movie_title_search', '');
        $this->session->set_userdata('movie_genre_search', '');
        $this->session->set_userdata('movie_mpaa_rating_search', '');
        $this->session->set_userdata('movie_year_released_search', '');
		$this->session->set_userdata('movie_persons_name_search', '');
        $this->session->set_userdata('movie_search_sql', '');

    } // end of - function clear_search_session_variables	
	
	
	
    public function get_movie_search_results($persons_name = '') {

//        if ($starts_with == '') {
//            $query = $this->db->get('movies');
//            return $query->result_array();	
//        }

//        $query = $this->db->get_where('movies', array('id' => $id));
//        return $query->row_array();               
        
        $sql = '';
        
        // Get search form values.
        $starts_with = $this->input->post('starts_with');
        $title_search = $this->input->post('title_search');
        $genre_search = $this->input->post('genre_search');
        $mpaa_rating_search = $this->input->post('mpaa_rating_search');
		$year_released_search = $this->input->post('year_released_search');
		$persons_name_search = $this->input->post('persons_name_search');
		
		
		// If a persons name wasn't entered in the form then check to see if one was passed in as a parameter.
		if ($persons_name_search == '') {
			if ($persons_name != '') {
				$persons_name = str_replace('_', ' ', $persons_name);
				$persons_name = urldecode(urldecode($persons_name));
			}
						
			$persons_name_search = $persons_name;
		} else {
			// Remove periods.  They cause problems.
			$persons_name_search = str_replace('.', '', $persons_name_search);
		}
        
        // if ($starts_with != '') {
        //     $this->session->set_userdata('movie_starts_with_search', $starts_with);
        // }
        $this->session->set_userdata('movie_starts_with_search', $starts_with);
        $this->session->set_userdata('movie_title_search', $title_search);
        $this->session->set_userdata('movie_genre_search', $genre_search);
        $this->session->set_userdata('movie_mpaa_rating_search', $mpaa_rating_search);
		$this->session->set_userdata('movie_year_released_search', $year_released_search);
		$this->session->set_userdata('movie_persons_name_search', $persons_name_search);
        
        
       
        if (($starts_with != '') || ($title_search != '') || ($genre_search != '') || ($mpaa_rating_search != '') || ($year_released_search != '') || ($persons_name_search != '')) {

           $this->session->set_userdata('movie_search_sql', '');

			$no_search_criteria_entered = false;
        } else {
        	$no_search_criteria_entered = true;
        }
        
        // If the session variable indicates to reuse the last search sql - reuse it.
        // if ($this->session->userdata('user_last_movie_search_sql') == 'yes') {
           // $sql = $this->session->userdata('movie_search_sql');
        // }

		
		// If not search criteria was passed then use the last saved search sql.
		// if (($no_search_criteria_entered) && ($this->session->userdata('movie_search_sql') != '')) {
			// $sql = $this->session->userdata('movie_search_sql');
		// } else if ($no_search_criteria_entered) {
			// $a_movies = array();
			// return $a_movies;
		// }
		
		// If no search criteris is entered then return an empty array.
		if ($no_search_criteria_entered) {
			$a_movies = array();
			return $a_movies;
		}		
		
		
        // if ($this->session->userdata('movie_search_sql') != '') {
        //    $sql = $this->session->userdata('movie_search_sql');
        // }        
        
        
        // If there is no value in the variable sql, create the sql statement.
        if ($sql == '') {
            
		// If a memeber is signed in then get member_movies data as well.
		if ($this->session->userdata('member_id') != '') {
			
            $sql = 'SELECT m.id, m.title, m.plot, m.genre, m.year_released, m.runtime, m.mpaa_rating, ' . 
            		'm.starring, m.directed_by, m.written_by, m.produced_by, m.image, m.imdb_image_url, m.featured, ' . 
            		'mm.id AS member_movie_id, mm.on_watch_list, mm.seen_it ' .  
                    'FROM movies AS m LEFT JOIN member_movies AS mm ON m.id = mm.movie_id ';
					
			} else {
				
	            $sql = 'SELECT id, title, plot, genre, year_released, runtime, mpaa_rating, starring, directed_by, written_by, produced_by, image, imdb_image_url, featured ' . 
	                    'FROM movies ';
				
			}

            // Add the where clause.
            if ($starts_with != '') {

                if ($starts_with == 'NUM') {
                    $sql .= 'WHERE title REGEXP "^[0-9]" ';
                } else {
                //} else {
                    $sql .= 'WHERE title LIKE "' . $starts_with . '%" ';
                }            

            } else {
                $sql .= 'WHERE 1 = 1 ';
            }

            if ($title_search != '') {
                $sql .= 'AND title LIKE "%' . $title_search . '%" ';
            }   

            if ($genre_search != '') {
                $sql .= 'AND genre LIKE "%' . $genre_search . '%" ';
            }            

            if ($mpaa_rating_search != '') {
                $sql .= 'AND mpaa_rating = "' . $mpaa_rating_search . '" ';
            }     

            if ($year_released_search != '') {
                $sql .= 'AND year_released = "' . $year_released_search . '" ';
            }     

             if ($persons_name_search != '') {
                $sql .= 'AND ((starring LIKE "%' . $persons_name_search . '%") ';
				$sql .= 'OR (directed_by LIKE "%' . $persons_name_search . '%") ';
				$sql .= 'OR (written_by LIKE "%' . $persons_name_search . '%") ';
				$sql .= 'OR (produced_by LIKE "%' . $persons_name_search . '%")) ';
            }

            $sql .= 'AND display = "yes" ';

            $sql .= 'ORDER BY title ';
			
			// Testing.
			//echo 'sql = ' . $sql;			

            // Save the SQL in a Session Variable.          
            $this->session->set_userdata('movie_search_sql', $sql);
                          
        }
            
        $query = $this->db->query($sql);
        return $query->result_array();

    } // end of - function get_movie_search_results    	
	
	
	
	/**
 	 * Get some random records.
	 */
	public function get_random_movies($limit = 5) {

		$sql = "SELECT * FROM movies WHERE id >= (SELECT FLOOR(MAX(id) * RAND()) FROM movies) ";
		$sql .= "AND display = 'yes' ";
		$sql .= "ORDER BY id LIMIT $limit";

		$query = $this->db->query($sql);
		
		return $query->result_array();

	} // end of - function get_random_movies
	
	
	
	
	/**
 	 * Select all records from the movies DB Table that don't have a value in the 'image' column and have a value
	 * in the imdb_image_url column.
	 * Then create a new image name, download the image and save it in the 'uploads/movies' folder.
	 */	
	public function upload_images_from_imdb() {
		
		$ci = get_instance();
		$ci->load->helper('common_functions');
		
		$sql = "SELECT id, title, image, imdb_image_url ";
		$sql .= "FROM movies ";
		$sql .= "WHERE image IS NULL ";
		$sql .= "AND imdb_image_url <> '' ";
		//$sql .= "AND imdb_image_url <> '' LIMIT 5";
		
		$query = $this->db->query($sql);
		
		foreach ($query->result() as $movie)
		{		   		 
			// Download the image if it hasn't already been.
			// --------------------------------------------.
			if (($movie->image == '') && ($movie->imdb_image_url != '')) {
				
				// Create the new file name.				
				$ext = '.' . pathinfo($movie->imdb_image_url, PATHINFO_EXTENSION);
				if ($ext != '') {
					//$simplified_title = str_replace(" ", "_", $movie->title);
					//$new_image_name = $simplified_title . '_' .time() . $ext;
					$new_image_name = format_string_for_file_name($movie->title) . '_' . time() . $ext;
					
					$filenameIn  = $movie->imdb_image_url;
					$filenameOut = MOVIE_IMAGE_PATH . $new_image_name;
					
					$contentOrFalseOnFailure   = file_get_contents($filenameIn);
					$byteCountOrFalseOnFailure = file_put_contents($filenameOut, $contentOrFalseOnFailure);
		
					$movie->image = $new_image_name;
					
					
					$data = array(
			               'image' => $movie->image,
			               'updated_at' => $datetime = date('Y-m-d H:i:s', time())
			            );
					
					$this->db->where('id', $movie->id);
					$this->db->update('movies', $data);
				}				
				
			}		   
		   
		}		
		
	} // end of - function upload_image_from_imdb
	
	
	
	
} // end of - class 

/* End of file movies_model.php */
/* Location: ./application/models/movies_model.php */