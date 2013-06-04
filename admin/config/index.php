<?php
require_once '../../library/config_admin.php';
require_once '../library/functions.php';

checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	default :
		$content 	= 'main.php';		
		$pageTitle 	= 'PLearning Admin Control Panel - PLearning Configuration';
}

//$script    = array('xyz.js');

require_once '../include/template.php';
?>
