<?php
require 'core/config.php';
$redirection_util = new Redirection_util();
$redirection_util->current_page = 'success';
$redirection_util->check_redirection(filter_input(INPUT_COOKIE, COOKIE_REDIRECTION_NAME));
$redirection_util->set_redirection_page();

$access_util = new Access_util();
$access_util->check_app_access();

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
	<div class="row">
		<div class="col-xs-12">
			<h2>Vielen Dank für Eure Teilnahme!</h2>
			<p>Die Ergebnise werden in Kürze ermittelt.</p>
			<hr>
			<p>Eure Gruppe:<br>
			<strong><?php
			$group_util = new Group($db_connection);
			echo $group_util->get_name(filter_input(INPUT_COOKIE, COOKIE_GROUP_ID));
			?></strong></p>
		</div><!-- /.col -->
	</div><!-- /.row -->
</section>
<?php
require DIR_VIEWS.'general/footer.php';
