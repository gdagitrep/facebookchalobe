<?php
require_once '../../library/config_admin.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'addTopic' :
		addTopic();
		break;
        
	case 'modifyTopic' :
		modifyTopic();
		break;
		
	case 'deleteTopic' :
		deleteTopic();
		break;
	
	case 'deleteImage' :
		deleteImage();
		break;
        
        case 'modifyThumb' :
            modifythumbnails();
            break;
    

	default :
	    // if action is not defined or unknown
		// move to main Topic page
		header('Location: index.php');
}


function addTopic()
{       
    $name        = $_POST['txtName'];
    $sql="SELECT max(topic_id) as s from topics";
    $result= dbQuery($sql) or die(mysql_error());
    $result= dbFetchAssoc($result);
    $Tid= $result['s'];
    $Tid =$Tid +1;

    $sql   = "INSERT INTO topics (topic_id, `name`)VALUES ('$Tid', '$name')";
    $result = dbQuery($sql) or die(mysql_error());

    $hey= $_REQUEST['coursesforTopic'];

    if (is_array($hey)) {
    foreach ($hey as $row) {
        $sql = "Insert into courses_topics (course_id, topic_id )values ('$row', '$Tid')";
        $result = dbQuery($sql) or die(mysql_error());
    }
    header("Location: index.php");
    }
    else {header("Location: index.php/oot");}
}

function modifyTopic()
{
	$TopicId   = (int)$_GET['TopicId'];	
    $catId       = $_POST['cboCategory'];
    $name        = $_POST['txtName'];
	$description = $_POST['mtxDescription'];
	$price       = str_replace(',', '', $_POST['txtPrice']);
	$qty         = $_POST['txtQty'];
	
	$images = uploadTopicImage('fleImage', SRV_ROOT . 'images/Topic/');

	$mainImage = $images['image'];
	$thumbnail = $images['thumbnail'];

	// if uploading a new image
	// remove old image
	if ($mainImage != '') {
		_deleteImage($TopicId);
		
		$mainImage = "'$mainImage'";
		$thumbnail = "'$thumbnail'";
	} else {
		// if we're not updating the image
		// make sure the old path remain the same
		// in the database
		$mainImage = 'pd_image';
		$thumbnail = 'pd_thumbnail';
	}
			
	$sql   = "UPDATE tbl_Topic 
	          SET cat_id = $catId, pd_name = '$name', pd_description = '$description', pd_price = $price, 
                        pd_qty = $qty, pd_image = $mainImage, pd_thumbnail = $thumbnail, pd_last_update = NOW()
			  WHERE pd_id = $TopicId";  

	$result = dbQuery($sql);
	
	header('Location: index.php');			  
}


/*
	Remove a Topic
*/
function deleteTopic()
{
	if (isset($_GET['TopicId']) && (int)$_GET['TopicId'] > 0) {
		$TopicId = (int)$_GET['TopicId'];
	} else {
		header('Location: index.php');
	}
	
	// remove any references to this Topic from
	// tbl_order_item and tbl_cart
	$sql = "DELETE FROM tbl_order_item
	        WHERE pd_id = $TopicId";
	dbQuery($sql);
			
	$sql = "DELETE FROM tbl_cart
	        WHERE pd_id = $TopicId";	
	dbQuery($sql);
			
	// get the image name and thumbnail
	$sql = "SELECT pd_image, pd_thumbnail
	        FROM tbl_Topic
			WHERE pd_id = $TopicId";
			
	$result = dbQuery($sql);
	$row    = dbFetchAssoc($result);
	
	// remove the Topic image and thumbnail
	if ($row['pd_image']) {
		unlink(SRV_ROOT . 'images/Topic/' . $row['pd_image']);
		unlink(SRV_ROOT . 'images/Topic/' . $row['pd_thumbnail']);
	}
	
	// remove the Topic from database;
	$sql = "DELETE FROM tbl_Topic 
	        WHERE pd_id = $TopicId";
	dbQuery($sql);
	
	header('Location: index.php?catId=' . $_GET['catId']);
}




?>