<?php
class Redirection_util{
	public $current_page = '';
	
	public function __construct() {
	}
	
	/**
	 * Checks if the redirection page stored in the cookie is the current page.
	 * If it is not, redirects the user.
	 */
	public function check_redirection($cookie) {
		if($cookie === NULL || $cookie === FALSE) {
			$this->current_page = 'index';
			$this->set_redirection_page();
			header('Location: /');
			die();
		} else if ($cookie !== $this->current_page) {
			header('Location: /' . $cookie);
			die();
		}
	}
	
	/**
	 * Sets the cookie that defines the page redirection.
	 */
	public function set_redirection_page() {
		setcookie(COOKIE_REDIRECTION_NAME, $this->current_page, time() + COOKIE_EXPIRE, '/');
		return true;
	}
}