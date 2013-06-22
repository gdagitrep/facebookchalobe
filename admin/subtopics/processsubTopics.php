<?php
require_once '../../library/config_admin.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'addsubTopic' :
		addsubTopic();
		break;
		
	case 'modifysubTopic' :
		modifysubTopic();
		break;
		
	case 'deletesubTopic' :
		deletesubTopic();
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


function addsubTopic()
{
        $name        = $_POST['txtName'];
        $cont = $_POST['txtcontent'];
        
        $sql="SELECT max(subt_id) as s from subtopics";
        $result= dbQuery($sql) or die(mysql_error());
        $row= dbFetchAssoc($result);
        $subTopicid= $row['s'];
        $subTopicid += 1;
	$sql   = "INSERT INTO subtopics (subt_id, `name`,content) VALUES ('$subTopicid', '$name','$cont')";
	$result = dbQuery($sql) or die(mysql_error());
        
        
        
        $hey= $_REQUEST['Topicsforsubtopic'];
        
        if (is_array($hey)) {
  foreach ($hey as $row) {
        $sql = "Insert into topics_subtopics (topic_id, subt_id )values ('$row', '$subTopicid')";
        $result = dbQuery($sql);
        }
        header("Location: index.php");
        }
	else {header("Location: index.php/?view=detail&subTopicId=".$subTopicid);}
}

/*
	Modify a Topic
*/
function modifysubTopic()
{
    $subTopicId   = (int)$_GET['subTopicId'];	
    $name        = $_POST['txtName'];
    $content = $_POST['mtxContent'];
    $sql   = "UPDATE subtopics SET name = '$name', content = '$content', date_updated = NOW()
			  WHERE subt_id = $subTopicId";  

    $result = dbQuery($sql) or die('Cannt'.mysql_error());
	header('Location: index.php?view=detail&subTopicId='.$subTopicId);
}

/*
	Remove a subTopic
*/
function deletesubTopic()
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