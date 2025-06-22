<?php
require_once 'core/Controller.php';

$c = isset($_GET['c']) ? $_GET['c'] : 'TaskController';
$m = isset($_GET['m']) ? $_GET['m'] : 'index';

require_once "controller/$c.php";

$controller = new $c();
$controller->$m();
?>
