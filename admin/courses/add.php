<?php
if (!defined('WEB_ROOT')) {
	exit;
}
$sql = "SELECT SU_id, name FROM universities ORDER BY SU_id";
	$universityList = dbQuery($sql) or die('Cannot get Course. ' . mysql_error());
?> 
<p>&nbsp;</p>
<form action="processCourse.php?action=addCourse" method="post" enctype="multipart/form-data" name="frmAddCourse" id="frmAddCourse">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr><td colspan="2" id="entryTableHeader">Add Course</td></tr>
  <tr> 
   <td width="150" class="label">Taught at Universities</td>
   <td class="content"> 
       <?php while( $row1=  dbFetchAssoc($universityList)) {
           extract($row1 );?>
       <input type="checkbox" name="univnamesforcourse[]" checked="checked"
              value="<?php echo $SU_id;
              ?>" /><?php echo $name;?><br>
	<?php } ?>
    </td>
  </tr>
  <tr> 
   <td width="150" class="label">Course Name</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" size="50" maxlength="100"></td>
  </tr>
  <tr> 
   <td width="150" class="label">Description</td>
   <td class="content"> <textarea name="mtxDescription" cols="70" rows="10" class="box" id="mtxDescription"></textarea></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnAddCourse" type="button" id="btnAddCourse" value="Add Course" onClick="submit();//checkAddCourseForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>
