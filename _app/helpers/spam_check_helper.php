<?php

function spam_check($p_loadtime) {

    $timelimit = 5;

    $totaltime = time() - $p_loadtime;

    if ($totaltime < $timelimit) {
		redirect('spam-detected', 'refresh');      
    } 

} // end of - function spam_check


// 
function encrypted_spam_check($e_loadtime, $timelimit = 10) {

	// Decrypt the past in value.
	$loadtime = decryptIt($e_loadtime);

    $totaltime = time() - $loadtime;

    if ($totaltime < $timelimit) {

  //   	$CI =& get_instance();

		// // Set message data and redirect to display the new item.
		// $CI->session->set_flashdata('message_class', 'alert-danger');
		// $CI->session->set_flashdata('message', 'e_loadtime = ' . $e_loadtime . ' -- loadtime = ' . $loadtime . '.');

		redirect('spam-detected', 'refresh');
    } 

} // end of - function encrypted_spam_check


/* End of file spam_check_helper.php */
/* Location: ./application/helpers/spam_check_helper.php */