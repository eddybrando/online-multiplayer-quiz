<?php
/**
 * Sets the values for the redirection utility.
 */
$redirection_util = new Redirection_util();
$redirection_util->current_page = 'question-' . $current_question;
$redirection_util->check_redirection(filter_input(INPUT_COOKIE, COOKIE_REDIRECTION_NAME));
$redirection_util->set_redirection_page();

/**
 * Sets the values for the access utility.
 */
$access_util = new Access_util();
$access_util->check_app_access();

/******************************************************************************/

/**
 * Checks if the form was sent.
 */
if(filter_input(INPUT_POST, 'form_submit') !== NULL &&
   filter_input(INPUT_POST, 'form_submit') === 'submitted') {

	$answer = filter_input(INPUT_POST, 'answer');

	if($answer === NULL) {
		$errors[] = 'ANSWER_EMPTY';
	} else {
		$answer_util = new Answer($db_connection);
		$answer_util->answer($current_question, $answer, filter_input(INPUT_COOKIE, COOKIE_GROUP_ID));

		if(isset( $last_question ) && $last_question === true) {
			$answer_util->finish(filter_input(INPUT_COOKIE, COOKIE_GROUP_ID));
			$redirection_util->current_page = 'success';
			$redirection_util->set_redirection_page();
			header('Location: /success');
			die();
		} else {
			$redirection_util->current_page = 'question-' . ( $current_question + 1 );
			$redirection_util->set_redirection_page();
			header('Location: /question-' . ( $current_question + 1 ));
			die();
		}
		
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
						if(in_array('ANSWER_EMPTY', $errors)) {
							?>
							<strong>Bitte Antwort wählen!</strong>
							<?php
						}
						?>
					</div>
				<?php
				}
				?>
				<h2>Antwort zur Frage <?php echo $current_question; ?>:</h2>
				<div class="form-group">
					<?php
					/**
					 * Prints the current question's answers.
					 */
					foreach($current_answers as $key => $current_answer) {
						?>
						<div class="radio">
							<label><input type="radio" name="answer" value="<?php echo ($key + 1); ?>"><?php echo $current_answer; ?></label>
						</div><!-- /.radio -->
						<?php
					}
					?>
				</div><!-- /.form-group -->
				<button type="submit" name="form_submit" value="submitted" class="btn btn-primary btn-full">Weiter <i class="fa fa-angle-right"></i></button>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</form>
</section>
<?php
require DIR_VIEWS.'general/footer.php';
