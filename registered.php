<?php
require 'core/config.php';
$redirection_util = new Redirection_util();
$redirection_util->current_page = 'registered';
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

	$redirection_util->current_page = 'question-1';
	$redirection_util->set_redirection_page();
	header('Location: /question-1');
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
				<!-- TODO: Get the group name from the database -->
				<h2>Deine Gruppe "<?php echo filter_input(INPUT_GET, 'name'); ?>" wurde erfolgreich registriert!</h2>
				<p>Wir wünschen euch viel Spaß!</p>
				<button type="submit" name="form_submit" value="submitted" class="btn btn-primary btn-full">Los geht's <i class="fa fa-angle-right"></i></button>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</form>
</section>
<?php
require DIR_VIEWS.'general/footer.php';
