<?php
require_once 'core/Controller.php';

$c = $_GET['c'] ?? 'TaskController';
$m = $_GET['m'] ?? 'index';

require_once "controller/$c.php";
$controller = new $c();
$controller->$m();


