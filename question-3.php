<?php
require 'core/config.php';

/**
 * Sets the current question number.
 */
$current_question = 3;
$last_question = true; // Set to TRUE if this is the last question

/**
 * Sets the answers.
 */
$current_answers = [
	'Option 1',
	'Option 2',
	'Option 3',
	'Option 4',
];

require DIR_VIEWS . 'question/general.php';
