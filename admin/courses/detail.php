<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a Course id exists
if (isset($_GET['CourseId']) && $_GET['CourseId'] > 0) {
	$detailCourseId = $_GET['CourseId'];
} else {
	// redirect to index.php if Course id is not present
	header('Location: index.php');
}

$sql = "SELECT name, description FROM courses WHERE course_id = $detailCourseId";
$result = mysql_query($sql) or die('Cannot get Course. ' . mysql_error());

$row = mysql_fetch_assoc($result);
extract($row);
?>
<p>&nbsp;</p>
<form action="processCourse.php?action=addCourse" method="post" enctype="multipart/form-data" name="frmAddCourse" id="frmAddCourse">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Course Name</td>
   <td class="content"> <?php echo $name; ?></td>
  </tr>
  <tr> 
   <td width="150" class="label">Description</td>
   <td class="content"><?php echo nl2br($description); ?> </td>
  </tr>
  <tr> 
   <td width="150" class="label">Universities</td>
   <td class="content"><img src="<?php echo $pd_image; ?>"></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnModifyCourse" type="button" id="btnModifyCourse" value="Modify Course" onClick="window.location.href='index.php?view=modify&CourseId=<?php echo $CourseId; ?>';" class="box">
  &nbsp;&nbsp;
  <input name="btnBack" type="button" id="btnBack" value=" Back " onClick="window.history.back();" class="box">
 </p>
</form>
