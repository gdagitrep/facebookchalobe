<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a Course id exists
if (isset($_GET['CourseId']) && $_GET['CourseId'] > 0) {
	$CourseId = $_GET['CourseId'];
} else {
	// redirect to index.php if Course id is not present
	header('Location: index.php');
}

// get Course info
$sql = "SELECT name, description FROM courses WHERE course_id = $detailCourseId";
$result = mysql_query($sql) or die('Cannot get Course. ' . mysql_error());
$row    = mysql_fetch_assoc($result);
extract($row);

$list= buildCategoryOptions($cat_id);
?> 
<form action="processCourse.php?action=modifyCourse&CourseId=<?php echo $CourseId; ?>" method="post" enctype="multipart/form-data" name="frmAddCourse" id="frmAddCourse">
 <p align="center" class="formTitle">Modify Course</p>
 
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Category</td>
   <td class="content"> <select name="cboCategory" id="cboCategory" class="box">
     <option value="" selected>-- Choose Category --</option>
<?php
	echo $list;
?>	 
    </select></td>
  </tr>
  <tr> 
   <td width="150" class="label">Course Name</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" value="<?php echo $pd_name; ?>" size="50" maxlength="100"></td>
  </tr>
  <tr> 
   <td width="150" class="label">Description</td>
   <td class="content"> <textarea name="mtxDescription" cols="70" rows="10" class="box" id="mtxDescription"><?php echo $pd_description; ?></textarea></td>
  </tr>
  <tr> 
   <td width="150" class="label">Price</td>
   <td class="content"><input name="txtPrice" type="text" class="box" id="txtPrice" value="<?php echo $pd_price; ?>" size="10" maxlength="7"> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Qty In Stock</td>
   <td class="content"><input name="txtQty" type="text" class="box" id="txtQty" value="<?php echo $pd_qty;  ?>" size="10" maxlength="10"> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Image</td>
   <td class="content"> <input name="fleImage" type="file" id="fleImage" class="box">
<?php
	if ($pd_thumbnail != '') {
?>
    <br>
    <img src="<?php echo WEB_ROOT . Course_IMAGE_DIR . $pd_thumbnail; ?>"> &nbsp;&nbsp;<a href="javascript:deleteImage(<?php echo $CourseId; ?>);">Delete 
    Image</a> 
    <?php
	}
?>    
    </td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnModifyCourse" type="button" id="btnModifyCourse" value="Modify Course" onClick="checkAddCourseForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>