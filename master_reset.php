<?php
require 'core/config.php';

/**
 * Delete groups.
 */
$sql = $db_connection->prepare("DELETE FROM groups");
$sql->execute();

header('Location: reset');
die();
