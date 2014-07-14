<?php 
//echo '<h1>Sniffspam.php</h1>' . chr(10);
/**
* This is a very basic but useful class( for stopping manual spamming)
* which can sniffs (Calculate spam points) based on certain criteria
* if spam points are greater than 2(spam points > 2) , content wont be inserted in DB
* if spam points are less than 2(spam points < 2) , content can be send for moderation
*
* @package    Comment/Content Spam Sniffer
* @author     Anirban Nath <anirban.mcs@gmail.com>
* @version    v 1.0 ( 12/Feb/2014)
*/


class Sniffspam {

    private static $spam_points = 0;

    public function calculate_spam_points($content) {

        self::$spam_points = 0;

        $url_pattern = '#(www\.|https?://)?[a-z0-9]+\.[a-z0-9]{2,4}\S*#i';

        preg_match_all($url_pattern, $content, $matches, PREG_PATTERN_ORDER);

        if (!empty($matches)) {
            //url is/are present

            $get_number_of_urls = count($matches[0]); // get the number of urls/emails present in content

            if ($get_number_of_urls > 2) {
                self::$spam_points += $get_number_of_urls; // 1 point per link
            } else {
                $spam_words_uri  = array('free', 'vote', 'play'); // url containing these keywords are considered to be spam

                // if less thamn 2 , check for length of url
                foreach ($matches[0] as $url) {
                    if(strlen($url) > 150) // long url mostly are spam
                       self::$spam_points += 1;

                    foreach($spam_words_uri as $spam) {
                        if(stripos($url, $spam) !== false ) 
                            self::$spam_points += 1;
                    }
                }
            }
        }

        $spam_words  = array('Levitra', 'viagra', 'casino', '*');  //Vulgars and banned words

       foreach ($spam_words as $spam) {

            if (stripos($content, $spam) !== false ) self::$spam_points += 1;

       }

       return self::$spam_points;

    }

} // end of - class