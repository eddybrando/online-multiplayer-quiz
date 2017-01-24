<?php
class Access_util{
	public function __construct() {
	}
	
	/**
	 * Checks if the user has general access to the app. If not, redirects him
	 * to the first page.
	 */
	public function check_app_access() {
		if(filter_input(INPUT_COOKIE, COOKIE_ACCESS_NAME) === NULL ||
		   filter_input(INPUT_COOKIE, COOKIE_ACCESS_NAME) !== COOKIE_ACCESS_VALUE) {
			header('Location: /');
			die();
		} else {
			return true;
		}
	}
}