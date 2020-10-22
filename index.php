<?php
session_start();

require_once("Dbconfig.php");
require_once("Pages/logout.php");
require_once("Pages/check.php");

$page = 'login';

if (isset($_GET["Pages"])) {
    $page = $_GET["Pages"];
}

include(sprintf('%s/%s.php', 'Pages', $page));
?>
