<?php
if (!defined('WEB_ROOT')) {
	exit;
}
if (isset($_GET['TopicId']) && $_GET['TopicId'] > 0) {
        $qTopicname= $_GET['Topicname'];
        $qTopicid= $_GET['TopicId'];
        $qQ_id=$_GET['questionId'];
} else {
	// redirect to index.php if Topic id is not present
	header('Location: index.php');
}

$sql = "SELECT subt_id, questiontext, type,answer,hint,solution,marks  from questions where Q_id ='$qQ_id';";
$result=  dbQuery($sql) or die('Cannot get Courses. ' . mysql_error());
$row= dbFetchAssoc($result);
extract($row);
if($type=='O'){
    $sql = "SELECT A,B,C,D,E from answer_objective where Q_id ='$qQ_id';";
    $result=  dbQuery($sql) or die('Cannot get Courses. ' . mysql_error());
    $row2= dbFetchAssoc($result);
    extract($row2);
}
?> 
<script>
    function objective(){
   jQuery('#objquestions').css('display', 'table-row');
   jQuery('#subquestions').css('display', 'none');
  jQuery('#mmrow').show();  
}
function subjective(){
    jQuery('#objquestions').css('display', 'none');
   jQuery('#subquestions').css('display', 'table-row');
      jQuery('#mmrow').hide();
}
</script>
<p>&nbsp;</p>
<form action="processquestions.php?action=editquestion&TopicId=<?php echo $qTopicid; ?>&Topicname=<?php echo $qTopicname; ?>&questionId=<?php echo $qQ_id; ?>&Qtype=<?php echo $type;?>" method="post" enctype="multipart/form-data" name="frmAddquestion" id="frmAddquestion">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
   <tr><td colspan="2" id="entryTableHeader1">Add Questions to topic <b><?php echo $qTopicname; ?></b></td></tr>
    <tr> 
   <td width="150" class="label">After Subtopic</td>
   <td class="content"> <select name="aftersubtopic" id="aftersubtopic" class="box">
<?php
$sql = "SELECT subtopics.name as stname, subtopics.subt_id  as stid from topics_subtopics inner join subtopics on subtopics.subt_id= topics_subtopics.subt_id where topic_id= '$qTopicid'";
$result = dbQuery($sql) or die('Cannot get Product. ' . mysql_error());
while($row = dbFetchAssoc($result)) {
    
?>
     <option value ="<?php echo $row['stid']; ?>" <?php if($row['stid']== $subt_id) echo "selected" ;?>><?php echo $row['stname']; ?></option>
<?php 
}
?>	 
    </select></td>
  </tr>   
   <tr> 
   <td width="100" class="label">Question</td>
   <td class="content"> 
       <textarea name="txtquestiontext"><?php echo $questiontext; ?></textarea>
   </td>
    
  </tr>
  <tr><td>Question type</td>
      <td>
          <input name="qtype" type="radio" value="O" onclick="jQuery(objective())" <?php if($type=='O') echo "checked";?>/>Objective<br>
          <input name="qtype" type="radio" value="S" onclick="jQuery(subjective())" <?php if($type=='S') echo "checked";?>/>Subjective
      </td>
  </tr>
  <tr id="mmrow" style="display:none"><td class="label">Maximum Marks</td>
    <td><input type="number" name="mm" id="mm" value="<?php echo $marks;?>" min="1" max="10"></td>
  </tr>
  <tr id="objquestions" <?php if($type=='S') {?>style="display: none"<?php }?>>
      <td colspan="2" style="padding-top: 40px">
          <input name="correctans" type="radio" value="A"<?php if($answer=='A') echo "checked"?>/><b style="font-size: 18">A</b> <textarea name="txtAoption"><?php if($type=='O') echo $A;?></textarea><br><br><br>
          <input name="correctans" type="radio" value="B"<?php if($answer=='B') echo "checked"?>/><b style="font-size: 18">B</b> <textarea name="txtBoption"><?php if($type=='O') echo $B;?></textarea><br><br><br>
          <input name="correctans" type="radio" value="C"<?php if($answer=='C') echo "checked"?>/><b style="font-size: 18">C</b> <textarea name="txtCoption"><?php if($type=='O') echo $C;?></textarea><br><br><br>
          <input name="correctans" type="radio" value="D"<?php if($answer=='D') echo "checked"?>/><b style="font-size: 18">D</b> <textarea name="txtDoption"><?php if($type=='O') echo $D;?></textarea><br><br><br>
          <input name="correctans" type="radio" value="E"<?php if($answer=='F') echo "checked"?>/><b style="font-size: 18">E</b> <textarea name="txtEoption"><?php if($type=='O') echo $E;?></textarea>
      </td>

  
  </tr>
  <tr id="subquestions" class="label" <?php if($type=='O') {?>style="display: none"<?php }?>>
      <td>Answer</td><td><textarea name="correctansS"><?php if($type=='S') echo $answer;?></textarea></td>
  </tr>
  <tr>
      <td>Hint</td>
      <td><textarea name="txthint"><?php echo $hint;?></textarea></td>
  </tr>
  <tr>
      <td>Explanation</td>
      <td><textarea name="txtexp"><?php echo $solution;?></textarea></td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btneditquestion" type="button" id="btneditquestion" value="Save question" onClick="checkAddQuestionForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>
