<?php

/**
 * Remove any bad characters, punctuation, spaces, etc. from strings 
 * to make them a better file name.
 *
 * @param string $string
 */
function format_string_for_file_name($string) {

	// $simplified_title = str_replace(" ", "_", $string);
	// $simplified_title = str_replace("&", "and", $simplified_title);
	// $simplified_title = str_replace("/", "_", $simplified_title);
	// $simplified_title = preg_replace('/[!:;?-]/', '', $simplified_title);
// 	
	// return $simplified_title;
	
	
	$clean_name = strtr($string, array('Š' => 'S','Ž' => 'Z','š' => 's','ž' => 'z','Ÿ' => 'Y','À' => 'A','Á' => 'A','Â' => 'A','Ã' => 'A','Ä' => 'A','Å' => 'A','Ç' => 'C','È' => 'E','É' => 'E','Ê' => 'E','Ë' => 'E','Ì' => 'I','Í' => 'I','Î' => 'I','Ï' => 'I','Ñ' => 'N','Ò' => 'O','Ó' => 'O','Ô' => 'O','Õ' => 'O','Ö' => 'O','Ø' => 'O','Ù' => 'U','Ú' => 'U','Û' => 'U','Ü' => 'U','Ý' => 'Y','à' => 'a','á' => 'a','â' => 'a','ã' => 'a','ä' => 'a','å' => 'a','ç' => 'c','è' => 'e','é' => 'e','ê' => 'e','ë' => 'e','ì' => 'i','í' => 'i','î' => 'i','ï' => 'i','ñ' => 'n','ò' => 'o','ó' => 'o','ô' => 'o','õ' => 'o','ö' => 'o','ø' => 'o','ù' => 'u','ú' => 'u','û' => 'u','ü' => 'u','ý' => 'y','ÿ' => 'y'));
	$clean_name = strtr($clean_name, array('Þ' => 'TH', 'þ' => 'th', 'Ð' => 'DH', 'ð' => 'dh', 'ß' => 'ss', 'Œ' => 'OE', 'œ' => 'oe', 'Æ' => 'AE', 'æ' => 'ae', 'µ' => 'u'));
	
	$clean_name = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $clean_name);	
	
	return $clean_name;

} // end of - function format_string_for_file_name


/**
 * Download an image from the provided URL and save it to the file system
 * using the nicely formatted imnage file name.
 *
 * @param string $image_url
 * @param string $image_path
 * @param string $image_name
 */
function download_image_from_url_and_save_it_to_the_file_system($image_url, $image_path, $image_name) {
	
	// Create the new file name.				
	$ext = '.' . pathinfo($image_url, PATHINFO_EXTENSION);
	if ($ext != '') {
		$new_image_name = format_string_for_file_name($image_name) . '_' . time() . $ext;
		
		$filenameIn  = $image_url;
		$filenameOut = $image_path . $new_image_name;
		
		$contentOrFalseOnFailure   = file_get_contents($filenameIn);
		$byteCountOrFalseOnFailure = file_put_contents($filenameOut, $contentOrFalseOnFailure);
		
		// Testing.
		//echo '<p>byteCountOrFalseOnFailure = ' . $byteCountOrFalseOnFailure . '</p>';
		
		if (($byteCountOrFalseOnFailure != false) && ($byteCountOrFalseOnFailure != '')) {
			return $new_image_name;
		} else {
			return false;
		}
		
	} else {
		
		return false;

	}
	
} // end of - function download_image_from_url_and_save_it_to_the_file_system




/* End of file common_functions_helper.php */
/* Location: ./application/helpers/common_functions_helper.php */



