<?php
require_once '../../library/config_admin.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	case 'addCourse' :
		addCourse();
		break;
		
	case 'modifyCourse' :
		modifyCourse();
		break;
		
	case 'deleteCourse' :
		deleteCourse();
		break;
	
	case 'deleteImage' :
		deleteImage();
		break;
        
        case 'modifyThumb' :
            modifythumbnails();
            break;
    

	default :
	    // if action is not defined or unknown
		// move to main Course page
		header('Location: index.php');
}


function addCourse()
{
    $name        = $_POST['txtName'];
	$description = $_POST['mtxDescription'];
	$sql="SELECT max(course_id) as s from courses nolock";
        $result= dbQuery($sql);
        $row= dbFetchAssoc($result);
        $cid= $row['s'];
        $cid= $cid +1;
	$sql   = "INSERT INTO courses ( course_id, `name`, description,  date_added, date_updated)
	          VALUES ('$cid', '$name', '$description', NOW(), NOW())";

	$result = dbQuery($sql);
        $hey= $_REQUEST['univnamesforcourse'];
        
        if (is_array($hey)) {
  foreach ($hey as $row) {
        $sql = "Insert into univs_courses (univ_id, course_id )values ('$row', '$cid')";
        $result = dbQuery($sql);
        }
        header("Location: index.php");
        }
	else {header("Location: index.php/oo");}
}

/*
	Upload an image and return the uploaded image name 
*/
function uploadCourseImage($inputName, $uploadDir)
{
	$image     = $_FILES[$inputName];
	$imagePath = '';
	$thumbnailPath = '';
	
	// if a file is given
	if (trim($image['tmp_name']) != '') {
		$ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];

		// generate a random new file name to avoid name conflict
		$imagePath = md5(rand() * time()) . ".$ext";
		
		list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 

		// make sure the image width does not exceed the
		// maximum allowed width
		if (LIMIT_Course_WIDTH && $width > MAX_Course_IMAGE_WIDTH) {
			$result    = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_Course_IMAGE_WIDTH);
			$imagePath = $result;
		} else {
			$result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
		}	
		
		if ($result) {
			// create thumbnail
			$thumbnailPath =  md5(rand() * time()) . ".$ext";
			$result = createThumbnail($uploadDir . $imagePath, $uploadDir . $thumbnailPath, THUMBNAIL_HEIGHT);
			
			// create thumbnail failed, delete the image
			if (!$result) {
				unlink($uploadDir . $imagePath);
				$imagePath = $thumbnailPath = '';
			} else {
				$thumbnailPath = $result;
			}	
		} else {
			// the Course cannot be upload / resized
			$imagePath = $thumbnailPath = '';
		}
		
	}

	
	return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
}

/*
	Modify a Course
*/
function modifyCourse()
{
	$CourseId   = (int)$_GET['CourseId'];	
    $catId       = $_POST['cboCategory'];
    $name        = $_POST['txtName'];
	$description = $_POST['mtxDescription'];
	$price       = str_replace(',', '', $_POST['txtPrice']);
	$qty         = $_POST['txtQty'];
	
	$images = uploadCourseImage('fleImage', SRV_ROOT . 'images/Course/');

	$mainImage = $images['image'];
	$thumbnail = $images['thumbnail'];

	// if uploading a new image
	// remove old image
	if ($mainImage != '') {
		_deleteImage($CourseId);
		
		$mainImage = "'$mainImage'";
		$thumbnail = "'$thumbnail'";
	} else {
		// if we're not updating the image
		// make sure the old path remain the same
		// in the database
		$mainImage = 'pd_image';
		$thumbnail = 'pd_thumbnail';
	}
			
	$sql   = "UPDATE tbl_Course 
	          SET cat_id = $catId, pd_name = '$name', pd_description = '$description', pd_price = $price, 
			      pd_qty = $qty, pd_image = $mainImage, pd_thumbnail = $thumbnail, pd_last_update = NOW()
			  WHERE pd_id = $CourseId";  

	$result = dbQuery($sql);
	
	header('Location: index.php');			  
}

/*
 * 
 */
function modifythumbnails(){
    $sql = "SELECT pd_image, pd_thumbnail FROM tbl_Course where (pd_image!='')";
    $result = dbQuery($sql) or die('Cannot get Course. ' . mysql_error());
    while($row = dbFetchArray($result)) {
        list($bigimage, $thumbimage) = $row;
        if($thumbimage!=''){
            rename( SRV_ROOT . 'images/Course/'.$thumbimage,  SRV_ROOT . 'images/Course/remainings/'.$thumbimage);
        }
        createThumbnail(SRV_ROOT . 'images/Course/'.$bigimage, SRV_ROOT . 'images/Course/'.$thumbimage, 100);
        
    }
    header("Location: index.php");
}

/*
	Remove a Course
*/
function deleteCourse()
{
	if (isset($_GET['CourseId']) && (int)$_GET['CourseId'] > 0) {
		$CourseId = (int)$_GET['CourseId'];
	} else {
		header('Location: index.php');
	}
	
	// remove any references to this Course from
	// tbl_order_item and tbl_cart
	$sql = "DELETE FROM tbl_order_item
	        WHERE pd_id = $CourseId";
	dbQuery($sql);
			
	$sql = "DELETE FROM tbl_cart
	        WHERE pd_id = $CourseId";	
	dbQuery($sql);
			
	// get the image name and thumbnail
	$sql = "SELECT pd_image, pd_thumbnail
	        FROM tbl_Course
			WHERE pd_id = $CourseId";
			
	$result = dbQuery($sql);
	$row    = dbFetchAssoc($result);
	
	// remove the Course image and thumbnail
	if ($row['pd_image']) {
		unlink(SRV_ROOT . 'images/Course/' . $row['pd_image']);
		unlink(SRV_ROOT . 'images/Course/' . $row['pd_thumbnail']);
	}
	
	// remove the Course from database;
	$sql = "DELETE FROM tbl_Course 
	        WHERE pd_id = $CourseId";
	dbQuery($sql);
	
	header('Location: index.php?catId=' . $_GET['catId']);
}
?>