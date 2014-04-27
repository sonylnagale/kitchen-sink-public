<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes whchen working
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

/*
|--------------------------------------------------------------------------
| Livefyre Configuration
|--------------------------------------------------------------------------
|
| Keys for Livefyre integration
|
*/
/* Production Network */
define('LIVEFYRE_NETWORK',				'client-solutions.fyre.co');
define('LIVEFYRE_NETWORK_KEY', 			'DB3NbkykLEYo78kRCrSrDJGQSzw=');
define('LIVEFYRE_JS_SOURCE_DOMAIN', 	'zor.livefyre.com');
define('LIVEFYRE_JS_SOURCE_URL',		'http://zor.livefyre.com/wjs/v3.0/javascripts/livefyre.js');
define('LIVEFYRE_SITE_ID', 				'351624');
define('LIVEFYRE_SITE_KEY',				'FeqOUZRn5oNm1keV+IVDeFOoO+o=');
define('LIVEFYRE_SITE_URL', 			'http://local.livefyre.com/');
define('LIVEFYRE_SYSTEM_USER_TOKEN', 	'eyJhbGciOiAiSFMyNTYiLCAidHlwIjogIkpXVCJ9.eyJkb21haW4iOiAiY2xpZW50LXNvbHV0aW9ucy5meXJlLmNvIiwgImV4cGlyZXMiOiAxNDAwODU4NTIyLjY3NjU5OCwgInVzZXJfaWQiOiAic3lzdGVtIn0.HBbCbJ_AwhEO4uJP3qyXhCCScM0WP5VHhNoCk_5H-2o');

/* Use the Livefyre library or not */
define('LIVEFYRE_LIBRARY',				true);

/* UAT Network 
define('LIVEFYRE_NETWORK',				'client-solutions-uat.fyre.co');
define('LIVEFYRE_NETWORK_SECRET', 		'hnoVNQcTknTarpqj51WXQ6fXyAo=');
define('LIVEFYRE_JS_SOURCE_DOMAIN', 	'zor.t402.livefyre.com');
define('LIVEFYRE_JS_SOURCE_URL',		'http://zor.t402.livefyre.com/wjs/v3.0/javascripts/livefyre.js');
define('LIVEFYRE_SITE_ID', 				'304792');
define('LIVEFYRE_SITE_KEY',				'm3hUQS3KuuuylIyT5pGuhjR7Ar8=');
define('LIVEFYRE_SITE_URL', 			'http://pcolombo.livefyre.com/');
define('LIVEFYRE_SYSTEM_USER_TOKEN', 	'eyJhbGciOiAiSFMyNTYiLCAidHlwIjogIkpXVCJ9.eyJkb21haW4iOiAiY2xpZW50LXNvbHV0aW9ucy11YXQuZnlyZS5jbyIsICJleHBpcmVzIjogMTM5ODUzNDgzMy41NjUzNDIsICJ1c2VyX2lkIjogInN5c3RlbSJ9.1QMfgW65-GX4qchXHuGScAr9PEbzQfSgWBbKh83axg0');
define('DEMO_MEDIA_WALL_ID',			'custom-1395952392273');
*/

define('DEMO_ARTICLE_ID_PREFIX',		'basic_local_');

// LF App Types
define('TYPE_LIVEBLOG',					'liveblog');
define('TYPE_LIVECHAT',					'livechat');
define('TYPE_LIVEREVIEWS',				'reviews');
define('TYPE_SIDENOTES',				'sidenotes');

// Array Keys
define('ARTICLE_ID',					'articleid');
define('ARTICLE_TITLE', 				'articletitle');
define('ARTICLE_URL', 					'articleurl');
define('ARTICLE_TAGS',					'articletags');
define('COLLECTION_TYPE',				'collectiontype');
define('COLLECTION_META', 				'collectionmeta');

// View Data Containers
define('DATA_NAV',						'datanav');
define('DATA_BODY',						'databody');


/* End of file constants.php */
/* Location: ./application/config/constants.php */