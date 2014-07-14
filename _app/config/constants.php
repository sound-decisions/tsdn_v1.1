<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');




// START OF - my own constants.

define('SITE_NAME', 'The Sound Decisions Network');
define('DISPLAY_SITE_NAME', '<span class="site-name">The Sound Decisions Network</span>');

define('COOKIE_EXPIRES', 31536000);	// 1 year in seconds.

// Indicate if emails can be sent or not.
define('SEND_EMAIL', 'no');
define('FROM_EMAIL', 'info@sound-decisions.ca');

define('MEMBER_PHOTOS_PATH', 'uploads/member_profile_photos/');
define('DEFAULT_PROFILE_PHOTO', 'default.jpg');
define('DEFAULT_PROFILE_PHOTO_TN', 'default_tn.jpg');

define('RECIPE_CATEGORY_PHOTOS_PATH', 'uploads/recipes/categories/');

define('MOVIE_IMAGE_PATH', 'uploads/movies/');

// For Tutorial.
define('UPLOADS_PATH', 'uploads/issue_covers/');


/* End of file constants.php */
/* Location: ./application/config/constants.php */