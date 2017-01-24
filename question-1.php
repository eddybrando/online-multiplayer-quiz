<?php
require 'core/config.php';

/**
 * Sets the current question number.
 */
$current_question = 1;

/**
 * Sets the answers.
 */
$current_answers = [
	'203',
	'214',
	'225',
	'236',
];

require DIR_VIEWS . 'question/general.php';
