<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'datamkdental';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

// $db['fb1']['hostname'] = 'localhost';
// $db['fb1']['username'] = 'root';
// $db['fb1']['password'] = '';
// $db['fb1']['database'] = 'datakdobiz';
// $db['fb1']['port'] = 3306;
// $db['fb1']['dbdriver'] = 'mysqli';
// $db['fb1']['dbprefix'] = '';
// $db['fb1']['pconnect'] = FALSE;
// $db['fb1']['db_debug'] = TRUE;
// $db['fb1']['cache_on'] = FALSE;
// $db['fb1']['cachedir'] = '';
// $db['fb1']['char_set'] = 'utf8';
// $db['fb1']['dbcollat'] = 'utf8_general_ci';
// $db['fb1']['swap_pre'] = '';
// $db['fb1']['autoinit'] = TRUE;
// $db['fb1']['stricton'] = FALSE;

// $db['fb2']['hostname'] = 'localhost';
// $db['fb2']['username'] = 'root';
// $db['fb2']['password'] = '';
// $db['fb2']['database'] = 'datakdobiz';
// $db['fb2']['port'] = 3306;
// $db['fb2']['dbdriver'] = 'mysqli';
// $db['fb2']['dbprefix'] = '';
// $db['fb2']['pconnect'] = FALSE;
// $db['fb2']['db_debug'] = TRUE;
// $db['fb2']['cache_on'] = FALSE;
// $db['fb2']['cachedir'] = '';
// $db['fb2']['char_set'] = 'utf8';
// $db['fb2']['dbcollat'] = 'utf8_general_ci';
// $db['fb2']['swap_pre'] = '';
// $db['fb2']['autoinit'] = TRUE;
// $db['fb2']['stricton'] = FALSE;

// $db['fb3']['hostname'] = 'localhost';
// $db['fb3']['username'] = 'root';
// $db['fb3']['password'] = '';
// $db['fb3']['database'] = 'datavis';
// $db['fb3']['port'] = 3306;
// $db['fb3']['dbdriver'] = 'mysqli';
// $db['fb3']['dbprefix'] = '';
// $db['fb3']['pconnect'] = FALSE;
// $db['fb3']['db_debug'] = TRUE;
// $db['fb3']['cache_on'] = FALSE;
// $db['fb3']['cachedir'] = '';
// $db['fb3']['char_set'] = 'utf8';
// $db['fb3']['dbcollat'] = 'utf8_general_ci';
// $db['fb3']['swap_pre'] = '';
// $db['fb3']['autoinit'] = TRUE;
// $db['fb3']['stricton'] = FALSE;

// $db['fb4']['hostname'] = 'localhost';
// $db['fb4']['username'] = 'root';
// $db['fb4']['password'] = '';
// $db['fb4']['database'] = 'hrms';
// $db['fb4']['port'] = 3306;
// $db['fb4']['dbdriver'] = 'mysqli';
// $db['fb4']['dbprefix'] = '';
// $db['fb4']['pconnect'] = FALSE;
// $db['fb4']['db_debug'] = TRUE;
// $db['fb4']['cache_on'] = FALSE;
// $db['fb4']['cachedir'] = '';
// $db['fb4']['char_set'] = 'utf8';
// $db['fb4']['dbcollat'] = 'utf8_general_ci';
// $db['fb4']['swap_pre'] = '';
// $db['fb4']['autoinit'] = TRUE;
// $db['fb4']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */