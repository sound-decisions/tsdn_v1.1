<?php
class IMDB_model extends CI_Model {

    var $imdb_url = '';
    var $api_url = '';
       
    
    public function __construct() {
        //$this->load->database();
        $this->imdb_url = 'http://www.imdb.com/title/';
        $this->api_url = 'http://www.omdbapi.com/';         
    }        
	
	
    public function get_imdb_movie($id = "0") {

        if ($id == "0") {
            return "No IMDB Movie ID";	
        }

        $json = file_get_contents($this->api_url . "?i=" . $id . "");

        $results = json_decode($json, true);
        //var_dump($results);        

        return $results;

    } // end of - function get_imdb_movie
    
    
    
    public function search_imdb_movies($title = '') {

        if ($title == '') {
            return "No Title to Search.";	
        }

        $title = urlencode($title);
        
        $json = file_get_contents($this->api_url . "?s=" . $title . "");

        $results = json_decode($json, true);
        //var_dump($results);    
        
        //$results = "Search For:  " . $title . "";

        return $results;

    } // end of - function search_imdb_movies
    
    
} // end of - class IMDB_model

/* End of file imdb_model.php */
/* Location: ./application/models/imdb_model.php */