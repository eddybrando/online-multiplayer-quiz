<?php
require 'core/config.php';
$redirection_util = new Redirection_util();
$redirection_util->current_page = 'register';
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

	$new_group = new Group($db_connection);
	$new_group->name = filter_input(INPUT_POST, 'group_name');

	if($new_group->name_is_valid()) {
    $group_id = $new_group->register();
		setcookie(COOKIE_GROUP_ID, $group_id, time() + COOKIE_EXPIRE, '/');
		$redirection_util->current_page = 'registered';
		$redirection_util->set_redirection_page();
		header('Location: /registered?id=' . $group_id . '&name=' .  urlencode($new_group->name));
		die();
	} else {
		$errors[] = 'GROUP_NAME_INVALID';
	}

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
				<?php
				/**
				 * Displays error messages.
				 */
				if(!empty($errors)) {
					?>
					<div class="alert alert-danger">
						<?php
						if(in_array('GROUP_NAME_INVALID', $errors)) {
							?>
							<strong>Der Name des Teams ist falsch!</strong><br>
							Der Name wird entweder bereits verwendet oder ist unzulässig.<br>
							Überprüfe deine Eingabe und versuch es erneut.
							<?php
						}
						?>
					</div>
				<?php
				}
				?>
				<p>Bitte registriere deine Gruppe</p>
				<div class="form-group">
					<label>Name des Teams</label>
					<input type="text" name="group_name" class="form-control input-lg" value="">
				</div><!-- /.form-group -->
				<button type="submit" name="form_submit" value="submitted" class="btn btn-primary btn-full">Gruppe registrieren <i class="fa fa-angle-right"></i></button>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</form>
</section>
<?php
require DIR_VIEWS.'general/footer.php';
