<?php
require 'core/config.php';
$redirection_util = new Redirection_util();
$redirection_util->current_page = 'index';
$redirection_util->check_redirection(filter_input(INPUT_COOKIE, COOKIE_REDIRECTION_NAME));
$redirection_util->set_redirection_page();

/******************************************************************************/

/**
 * Checks the entry code if sent.
 */
if(filter_input(INPUT_POST, 'form_submit') !== NULL &&
   filter_input(INPUT_POST, 'form_submit') === 'submitted') {
	
	if(strtolower( filter_input( INPUT_POST, 'entry_code' ) ) === ENTRY_CODE) {
		setcookie(COOKIE_ACCESS_NAME, COOKIE_ACCESS_VALUE, time() + COOKIE_EXPIRE, '/');
		$redirection_util->current_page = 'welcome';
		$redirection_util->set_redirection_page();
		header('Location: /welcome');
		die();
	} else {
		setcookie(COOKIE_ACCESS_NAME, '', 1, '/');
		$errors[] = 'ENTRY_CODE_INVALID';
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
						if(in_array('ENTRY_CODE_INVALID', $errors)) {
							?>
							<strong>Der Zugangscode ist falsch!</strong><br>
							Überprüfe den Zugangscode und versuch es erneut.
							<?php
						}
						?>
					</div>
				<?php
				}
				?>
				<div class="form-group">
					<label>Zugangscode</label>
					<input type="text" name="entry_code" class="form-control input-lg" value="">
				</div><!-- /.form-group -->
				<button type="submit" name="form_submit" value="submitted" class="btn btn-primary btn-full">Weiter <i class="fa fa-angle-right"></i></button>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</form>
</section>
<?php
require DIR_VIEWS.'general/footer.php';