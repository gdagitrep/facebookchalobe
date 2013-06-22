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

$sql = "SELECT Q_id,questiontext,`type`,subt_id,answer,hint,solution   FROM questions where subt_id IN (SELECT topics_subtopics.subt_id from 
topics_subtopics where topic_id= '$qTopicid'); ";
$questionList = dbQuery($sql) or die('Cannot get Courses. ' . mysql_error());
?>
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
    <tr><td colspan="2" id="entryTableHeader1">Questions to topic <b><?php echo $qTopicname; ?></b></td></tr>
</table>
<?php
while($row = dbFetchAssoc($questionList)){
    extract($row);
?> 
<p>&nbsp;</p>

<form action="processquestions.php?action=viewquestion" method="post" enctype="multipart/form-data" name="frmeditquestion" id="frmeditquestion">
    <table width="100%" border="1" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">After Subtopic</td>
   <td class="content"> <?php echo $subt_id; ?></td>
  </tr>   
  <tr> 
   <td width="100" class="label">Question</td>
   <td class="content"> 
       <?php echo $questiontext;?>
   </td>
    
  </tr>
  <tr class="label"><td>Question type</td>
      <td>
          <?php echo $type;?>
      </td>
  </tr>
  <?php if($type =='O'){ 
      $sql2= "select A, B, C,D,E from answer_objective where Q_id='$Q_id';";
      $result2=dbQuery($sql2) or die('cannot get questions'.mysql_error());
      $rwo= dbFetchAssoc( $result2);
      extract($rwo);
      
      ?>
  <tr class="label" >
      <td> Options </td>
      <td class="content">
          
         <p><?php echo $A; ?></p><br>
         <p><?php echo $B; ?></p><br>
         <p><?php echo $C; ?></p><br>
         <p><?php echo $D; ?></p><br>
         <p><?php echo $E; ?></p><br>
         
      </td>
  </tr>
  
  <?php }
   ?>
  <tr id="subquestions" class="label">
      <td>Answer</td><td><?php echo $answer;?></td>
  </tr>
  <tr class="label" >
      <td> Hint </td>
      <td class="content"><?php echo $hint;?></td>
  </tr>
  <tr class="label" >
      <td> Explanation </td>
      <td><?php echo $solution;?></td>
  </tr>
  
    <tr>
<!-- <p align="center"> -->
      <td colspan="2">
  <input name="btneditquestion" type="button" id="btneditquestion" value="Edit question" onClick="window.location.href='index.php?view=editquestion&TopicId=<?php echo $qTopicid; ?>&Topicname=<?php echo $qTopicname; ?>&questionId=<?php echo $Q_id; ?>';" class="box">
<!--  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  -->
      </td>
    </tr>
    <tr style="background-color: black"></tr>
</table>

</form>

<?php  } ?>