<?php
require_once '../../library/config_admin.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {
	
    case 'add' :
        addUniversity();
        break;
      
    case 'modify' :
        modifyUniversity();
        break;
        
    case 'delete' :
        deleteUniversity();
        break;
   
    
	   
    default :
        // if action is not defined or unknown
        // move to main University page
        header('Location: index.php');
}


/*
    Add a University
*/
function addUniversity()
{
    $name        = $_POST['txtName'];
    //$parentId    = $_POST['hidParentId']; /// pata nahi kaun sa bhanwar hai
    
    
    $sql   = "INSERT INTO universities (`Name`) 
              VALUES ('$name')";
    $result = dbQuery($sql) or die('Cannot add University' . mysql_error());
    
    header('Location: index.php');              
}

/*
    Upload an image and return the uploaded image name 
*/
function uploadImage($inputName, $uploadDir)
{
    $image     = $_FILES[$inputName];
    $imagePath = '';
    
    // if a file is given
    if (trim($image['tmp_name']) != '') {
        // get the image extension
        $ext = substr(strrchr($image['name'], "."), 1); 

        // generate a random new file name to avoid name conflict
        $imagePath = md5(rand() * time()) . ".$ext";
        
		// check the image width. if it exceed the maximum
		// width we must resize it
		$size = getimagesize($image['tmp_name']);
		
		if ($size[0] > MAX_CATEGORY_IMAGE_WIDTH) {
			$imagePath = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_CATEGORY_IMAGE_WIDTH);
		} else {
			// move the image to category image directory
			// if fail set $imagePath to empty string
			if (!move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath)) {
				$imagePath = '';
			}
		}	
    }

    
    return $imagePath;
}

/*
    Modify a University
*/
function modifyUniversity()
{
    $catId       = (int)$_GET['catId'];
    $name        = $_POST['txtName'];
    
     
    $sql    = "UPDATE tbl_University 
               SET cat_name = '$name'
               WHERE cat_id = $catId";
           
    $result = dbQuery($sql) or die('Cannot update University. ' . mysql_error());
    header('Location: index.php');              
}

/*
    Remove a University
*/
function deleteUniversity()
{
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }
    
	// find all the children categories
	$children = getChildren($catId);
	
	// make an array containing this University and all it's children
	$categories  = array_merge($children, array($catId));
	$numUniversity = count($categories);

	// remove all product image & thumbnail 
	// if the product's University is in  $categories
	$sql = "SELECT pd_id, pd_image, pd_thumbnail
	        FROM tbl_product
			WHERE cat_id IN (" . implode(',', $categories) . ")";
	$result = dbQuery($sql);
	
	while ($row = dbFetchAssoc($result)) {
		@unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_image']);	
		@unlink(SRV_ROOT . PRODUCT_IMAGE_DIR . $row['pd_thumbnail']);
	}
	
	// delete the products
	$sql = "DELETE FROM tbl_product
			WHERE cat_id IN (" . implode(',', $categories) . ")";
	dbQuery($sql);
	
	
    // finally remove the University from database;
    $sql = "DELETE FROM tbl_University 
            WHERE cat_id IN (" . implode(',', $categories) . ")";
    dbQuery($sql);
    
    header('Location: index.php');
}


/*
	Recursively find all children of $catId
*/
function getChildren($catId)
{
    $sql = "SELECT cat_id ".
           "FROM tbl_University ".
           "WHERE cat_parent_id = $catId ";
    $result = dbQuery($sql);
    
	$cat = array();
	if (dbNumRows($result) > 0) {
		while ($row = dbFetchRow($result)) {
			$cat[] = $row[0];
			
			// call this function again to find the children
			$cat  = array_merge($cat, getChildren($row[0]));
		}
    }

    return $cat;
}


/*
    Remove a University image
*/
function deleteImage()
{
    if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
        $catId = (int)$_GET['catId'];
    } else {
        header('Location: index.php');
    }
    
	_deleteImage($catId);
	
	// update the image name in the database
	$sql = "UPDATE tbl_University
			SET cat_image = ''
			WHERE cat_id = $catId";
	dbQuery($sql);        

    header("Location: index.php?view=modify&catId=$catId");
}

/*
	Delete a University image where University = $catId
*/
function _deleteImage($catId)
{
    // we will return the status
    // whether the image deleted successfully
    $deleted = false;

	// get the image(s)
    $sql = "SELECT cat_image 
            FROM tbl_University
            WHERE cat_id ";
	
	if (is_array($catId)) {
		$sql .= " IN (" . implode(',', $catId) . ")";
	} else {
		$sql .= " = $catId";
	}	

    $result = dbQuery($sql);
    
    if (dbNumRows($result)) {
        while ($row = dbFetchAssoc($result)) {
	        // delete the image file
    	    $deleted = @unlink(SRV_ROOT . CATEGORY_IMAGE_DIR . $row['cat_image']);
		}	
    }
    
    return $deleted;
}

?>
