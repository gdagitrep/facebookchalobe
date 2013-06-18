<?php
require_once '../../library/config_admin.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'CourseLamp Admin Control Panel - View University';
		break;

	case 'add' :
		$content 	= 'add.php';		
		$pageTitle 	= 'CourseLamp Admin Control Panel - Add University';
		break;

	case 'modify' :
		$content 	= 'modify.php';		
		$pageTitle 	= 'CourseLamp Admin Control Panel - Modify University';
		break;

	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'CourseLamp Admin Control Panel - View University';
}


$script    = array('university.js');

require_once '../include/template.php';
?>
