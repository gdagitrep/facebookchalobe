<?php
require_once '../../library/config_admin.php';
require_once '../library/functions.php';

$_SESSION['login_return_url'] = $_SERVER['REQUEST_URI'];
checkUser();

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {
	case 'list' :
		$content 	= 'list.php';		
		$pageTitle 	= 'PLearning Admin Control Panel - View Topic';
		break;

	case 'add' :
		$content 	= 'add.php';		
		$pageTitle 	= 'PLearning Admin Control Panel - Add Topic';
		break;
        case 'addquestion' :
		$content 	= 'addquestion.php';		
		$pageTitle 	= 'PLearning Admin Control Panel - Add Question';
		break;
            case 'viewquestion' :
		$content 	= 'viewquestion.php';		
		$pageTitle 	= 'PLearning Admin Control Panel - View Questions';
		break;
            case 'editquestion' :
		$content 	= 'editquestion.php';		
		$pageTitle 	= 'PLearning Admin Control Panel - Edit Questions';
		break;

	case 'modify' :
		$content 	= 'modify.php';		
		$pageTitle 	= 'PLearning Admin Control Panel - Modify Topic';
		break;

	case 'detail' :
		$content    = 'detail.php';
		$pageTitle  = 'PLearning Admin Control Panel - View Topic Detail';
		break;
		
	default :
		$content 	= 'list.php';		
		$pageTitle 	= 'PLearning Admin Control Panel - View Topic';
}

$script    = array('CourseTopic.js');

require_once '../include/template.php';
?>