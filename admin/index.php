<?php
require_once '../library/config_admin.php';
require_once './library/functions.php';

checkUser();

$content = 'main.php';

$pageTitle = 'CourseLamp Admin';
$script = array();

require_once 'include/template.php';
?>
