<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// set the default page title
$pageTitle = 'CourseLamp';

// if a product id is set add the product name
// to the page title but if the product id is not
// present check if a category id exist in the query string
// and add the category name to the page title
//if (isset($_GET['p']) && (int)$_GET['p'] > 0) {
//	$pdId = (int)$_GET['p'];
//	$sql = "SELECT pd_name
//			FROM tbl_product
//			WHERE pd_id = $pdId";
//	
//	$result    = dbQuery($sql);
//	$row       = dbFetchAssoc($result);
//	$pageTitle = $row['pd_name'];
//	
//} else if (isset($_GET['c']) && (int)$_GET['c'] > 0) {
//	$catId = (int)$_GET['c'];
//	$sql = "SELECT cat_name
//	        FROM tbl_category
//			WHERE cat_id = $catId";
//
//    $result    = dbQuery($sql);
//	$row       = dbFetchAssoc($result);
//	$pageTitle = $row['cat_name'];
//}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $pageTitle; ?></title>
<meta name="keywords" content="online courses, engineering courses, indian colleges" />
<meta name="description" content="Online study material for various college/university courses. Questions for assessment" />
<link href='/images/sparta.png'  rel="shortcut icon"/>
<!--<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500&subset=latin,greek' rel='stylesheet' type='text/css'></link>-->
<link href="stylesheet/templatemo_style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="stylesheet/styles.css" />
<link rel="stylesheet" href="stylesheet/demo.css" type="text/css"  media="screen" /> 
<!--<link rel="stylesheet" href="stylesheet/orangebox.css" type="text/css" />-->

<script language="javascript" type="text/javascript">

function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}

</script>
<script type="text/javascript" src="scripts/jquery-1.10.0.min.js"></script>
<script type="text/javascript" src="scripts/jquery.animate-shadow-min.js"></script>
<script type="text/javascript" src="scripts/Courselamp_functions.js"></script>
<script src="scripts/jquery.localscroll-1.2.7-min.js" type="text/javascript"></script>
<script src="scripts/jquery.scrollTo-1.4.3.1-min.js" type="text/javascript"></script> 
<!--<script type="text/javascript" src="scripts/jquery.scrollTo-1.4.3.1-min.js"></script>-->
<!--<script type="text/javascript" src="scripts/orangebox.min.js"></script>
<script language="javascript" type="text/javascript" src="scripts/mootools-1.2.1-core.js"></script>
<script language="javascript" type="text/javascript" src="scripts/mootools-1.2-more.js"></script>
<script language="javascript" type="text/javascript" src="scripts/slideitmoo-1.1.js"></script>
<script type="text/javascript" src="scripts/bsn.AutoSuggest_2.1.3.js"></script>
<link rel="stylesheet" href="stylesheet/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
-->
<script language="javascript" type="text/javascript">
//	window.addEvents({
//		'domready': function(){
//			/* thumbnails example , div containers */
//			new SlideItMoo({
//						overallContainer: 'SlideItMoo_outer',
//						elementScrolled: 'SlideItMoo_inner',
//						thumbsContainer: 'SlideItMoo_items',		
//						itemsVisible: 5,
//						elemsSlide: 3,
//						duration: 200,
//						itemsSelector: '.SlideItMoo_element',
//						itemWidth: 140,
//						showControls:1});
//		}
//	});
//jQuery(window).load(function(){
    jQuery(document).click(function(e) {
        // check that your clicked
        // element has no id=info
    if( e.target.id != 'progress_dropdown') {
      $("#progress_dropdown").hide();
    }
    });
//    });
</script> 
<script type="text/javascript" src="admin/library/js/tinymce/jscripts/tiny_mce/plugins/asciimath/js/ASCIIMathMLwFallback.js"></script>
<script type="text/javascript" src="admin/library/js/tinymce/jscripts/tiny_mce/plugins/asciisvg/js/ASCIIsvg.js"></script>
<script type="text/javascript">
// var AScgiloc = 'http://www.imathas.com/imathas/filter/graph/svgimg.php';
 var AMTcgiloc = "http://www.imathas.com/cgi-bin/mimetex.cgi";
</script>
</head>


