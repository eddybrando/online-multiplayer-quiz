<?php
require 'core/config.php';
$redirection_util = new Redirection_util();
$redirection_util->current_page = 'welcome';
$redirection_util->check_redirection(filter_input(INPUT_COOKIE, COOKIE_REDIRECTION_NAME));
$redirection_util->set_redirection_page();

$access_util = new Access_util();
$access_util->check_app_access();

/******************************************************************************/

/**
 * Checks if the form was sent.
 */
if(filter_input(INPUT_POST, 'form_submit') !== NULL &&
   filter_input(INPUT_POST, 'form_submit') === 'submitted') {

	$redirection_util->current_page = 'register';
	$redirection_util->set_redirection_page();
	header('Location: /register');
	die();

}

/******************************************************************************/

/**
 * Adds the HTML head.
 */
require DIR_VIEWS.'general/html-head.php';

/**
 * Adds the header of the app.
 */
require DIR_VIEWS.'general/header.php';
?>
<section>
	<form method="post" action="">
		<div class="row">
			<div class="col-xs-12">
				<h2>Multiplayer Online Quiz!</h2>
				<button type="submit" name="form_submit" value="submitted" class="btn btn-primary btn-full">Weiter <i class="fa fa-angle-right"></i></button>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</form>
</section>
<?php
require DIR_VIEWS.'general/footer.php';
