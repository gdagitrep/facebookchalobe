<?php
if (!defined('WEB_ROOT')) {
	exit;
}
$sql = "SELECT course_id, name FROM courses ORDER BY course_id";
	$coursesList = dbQuery($sql) or die('Cannot get Courses. ' . mysql_error());
?> 
<p>&nbsp;</p>
<form action="processTopics.php?action=addTopic" method="post" enctype="multipart/form-data" name="frmAddTopic" id="frmAddTopic">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr><td colspan="2" id="entryTableHeader">Add Topic</td></tr>
  <tr> 
   <td width="150" class="label">Included in Courses</td>
   <td class="content"> 
       <?php while( $row1=  dbFetchAssoc($coursesList)) {
           extract($row1 );?>
       <input type="checkbox" name="coursesforTopic[]" 
              value="<?php echo $course_id;
              ?>" /><?php echo $name;?><br>
	<?php } ?>
    </td>
  </tr>
  <tr> 
   <td width="150" class="label">Topic Name</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" size="50" maxlength="100"></td>
  </tr>
  
 </table>
 <p align="center"> 
  <input name="btnAddTopic" type="button" id="btnAddTopic" value="Add Topic" onClick="submit();//checkAddTopicForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>
