<?php
if (!defined('WEB_ROOT')) {
	exit;
}
if (isset($_GET['TopicId']) && $_GET['TopicId'] > 0) {
        $qTopicname= $_GET['Topicname'];
        $qTopicid= $_GET['TopicId'];
} else {
	// redirect to index.php if Topic id is not present
	header('Location: index.php');
}
//
//$sql = "SELECT course_id, name FROM courses ORDER BY course_id";
//	$coursesList = dbQuery($sql) or die('Cannot get Courses. ' . mysql_error());
?> 
<script>
    function objective(){
   jQuery('#objquestions').css('display', 'table-row');
   jQuery('#subquestions').css('display', 'none');
}
function subjective(){
    jQuery('#objquestions').css('display', 'none');
   jQuery('#subquestions').css('display', 'table-row');
}
</script>
<p>&nbsp;</p>
<form action="processquestions.php?action=addquestion&TopicId=<?php echo $qTopicid; ?>&Topicname=<?php echo $qTopicname; ?>" method="post" enctype="multipart/form-data" name="frmAddquestion" id="frmAddquestion">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
   <tr><td colspan="2" id="entryTableHeader1">Add Questions to topic <b><?php echo $qTopicname; ?></b></td></tr>
    <tr> 
   <td width="150" class="label">After Subtopic</td>
   <td class="content"> <select name="aftersubtopic" id="aftersubtopic" class="box">
     <option value="0" selected>-- Choose Subtopic after which questions appear --</option>
<?php
$sql = "SELECT subtopics.name as stname, subtopics.subt_id  as stid from topics_subtopics inner join subtopics on subtopics.subt_id= topics_subtopics.subt_id where topic_id= '$qTopicid'";
$result = dbQuery($sql) or die('Cannot get Product. ' . mysql_error());
while($row = dbFetchAssoc($result)) {
    
?>
     <option value ="<?php echo $row['stid']; ?>"><?php echo $row['stname']; ?></option>
<?php 
}
?>	 
    </select></td>
  </tr>   
   <tr> 
   <td width="100" class="label">Question</td>
   <td class="content"> 
       <textarea name="txtquestiontext"></textarea>
<!--       <input name="txtName" type="text" class="box" id="txtName" size="50" maxlength="100">-->
   </td>
    
  </tr>
  <tr><td>Question type</td>
      <td>
          Objective (only this type is enabled for now)
<!--          <input name="qtype" type="radio" value="O" onclick="jQuery(objective())"/>Objective<br>
          <input name="qtype" type="radio" value="S" onclick="jQuery(subjective())"/>Subjective-->
      </td>
  </tr>
  <tr id="objquestions" class="label" >
      <td colspan="2">
          <input type="radio" name="correctans" value="0" checked="checked" style="display:none;" />
          <input name="correctans" type="radio" value="A"/><b style="font-size: 18">A</b> <textarea name="txtAoption"></textarea><br><br><br>
          <input name="correctans" type="radio" value="B"/><b style="font-size: 18">B</b> <textarea name="txtBoption"></textarea><br><br><br>
          <input name="correctans" type="radio" value="C"/><b style="font-size: 18">C</b> <textarea name="txtCoption"></textarea><br><br><br>
          <input name="correctans" type="radio" value="D"/><b style="font-size: 18">D</b> <textarea name="txtDoption"></textarea><br><br><br>
          <input name="correctans" type="radio" value="E"/><b style="font-size: 18">E</b> <textarea name="txtEoption"></textarea>
      </td>

  
  </tr>
  <tr id="subquestions" class="label" style="display: none">
      <td>Answer</td><td><textarea name="correctansS"></textarea></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnAddquestion" type="button" id="btnAddquestion" value="Save question" onClick="checkAddQuestionForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>
