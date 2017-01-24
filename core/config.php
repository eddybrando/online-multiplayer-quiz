<?php
/**
 * Sets up the URL of the local environment. This is "localhost" by default, but
 * can be adjusted if needed.
 */
define('ENV_LOCAL_URL') = 'localhost';

/**
 * Checks the server name and sets the environment.
 */
if(strstr(filter_input(INPUT_SERVER, 'SERVER_NAME'), ENV_LOCAL_URL)) {
	define('ENVIRONMENT', 'DEV');
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
} else {
	define('ENVIRONMENT', 'LIVE');
}

/**
 * Variable to store general errors in the app.
 */
$errors = [];

/**
 * Defines app constants.
 */
define('ENTRY_CODE', 'password'); // App's password
define('COOKIE_ACCESS_NAME', 'appAccess');
define('COOKIE_ACCESS_VALUE', 's0d983rh203983');
define('COOKIE_EXPIRE', 60*60*24); // 1 day
define('COOKIE_GROUP_ID', 'appGroId');
define('COOKIE_REDIRECTION_NAME', 'appRedSit');
define('ANSWERS_QTY', '3'); // Quantity of questions
define('ANSWER_1', '2'); // Question's correct answer
define('ANSWER_2', '2'); // Question's correct answer
define('ANSWER_3', '2'); // Question's correct answer
define('ANSWER_POINTS', '1'); // Points for each correct answer

/**
 * Defines the dir constants of the app.
 */
define('DIR', realpath(__DIR__.DIRECTORY_SEPARATOR.'..'));
define('ROOT', '/');
define('DIR_IMG', ROOT.'img/');
define('DIR_VIEWS', DIR.DIRECTORY_SEPARATOR.'views/');

/**
 * Starts the database connection.
 */
require 'database.php';

/**
 * Requires the classes.
 */
require 'classes/access_util.php';
require 'classes/group.php';
require 'classes/answer.php';
require 'classes/redirection_util.php';
