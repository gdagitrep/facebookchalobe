<?php
require_once '../../library/config_admin.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'CourseLamp Admin Control Panel - View Users';
		break;

	case 'add' :
		$content 	= 'add.php';		
		$pageTitle 	= 'CourseLamp Admin Control Panel - Add Users';
		break;

	case 'modify' :
		$content 	= 'modify.php';		
		$pageTitle 	= 'CourseLamp Admin Control Panel - Modify Users';
		break;

	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'CourseLamp Admin Control Panel - View Users';
}

$script    = array('user.js');

require_once '../include/template.php';
?>
