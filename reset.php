<?php
require 'core/config.php';
setcookie(COOKIE_REDIRECTION_NAME, '', 1, '/');
setcookie(COOKIE_GROUP_ID, '', 1, '/');
setcookie(COOKIE_ACCESS_NAME, '', 1, '/');
header('Location: /');
die();
