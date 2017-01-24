<?php
require 'core/config.php';

/**
 * Sets the current question number.
 */
$current_question = 2;

/**
 * Sets the answers.
 */
$current_answers = [
	'5% Rabatt / 5€ Zuschuss',
	'5% Rabatt / 10€ Zuschuss',
	'10% Rabatt / 5€ Zuschuss',
	'10% Rabatt / 10€ Zuschuss',
];

require DIR_VIEWS . 'question/general.php';
