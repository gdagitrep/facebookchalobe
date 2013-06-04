<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a Topic id exists
if (isset($_GET['TopicId']) && $_GET['TopicId'] > 0) {
	$detailTopicId = $_GET['TopicId'];
        $detailTopicname= $_GET['TopicName'];
} else {
	// redirect to index.php if Topic id is not present
	header('Location: index.php');
}
//
//$sql = "SELECT name, description FROM courses WHERE course_id = $detailTopicId";
//$result = mysql_query($sql) or die('Cannot get Course. ' . mysql_error());
//
//$row = mysql_fetch_assoc($result);
//extract($row);
?>
<p>&nbsp;</p>
<form action="processTopics.php?action=addTopic" method="post" enctype="multipart/form-data" name="frmAddTopic" id="frmAddTopic">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Topic Name</td>
   <td class="content"> <?php echo $detailTopicname; ?></td>
  </tr>
  <tr> 
   <td width="150" class="label">Included in Courses</td>
   <td class="content"><?php echo "baad mai"; ?></td>
  </tr>
 
 </table>
 <p align="center"> 
  <input name="btnModifyTopic" type="button" id="btnModifyTopic" value="Modify Topic" onClick="window.location.href='index.php?view=modify&TopicId=<?php echo $detailTopicId; ?>';" class="box">
  &nbsp;&nbsp;
  <input name="btnviewquestion" type="button" id="btnviewquestion" value="View questions" onClick="window.location.href='index.php?view=viewquestion&TopicId=<?php echo $detailTopicId; ?>&Topicname=<?php echo $detailTopicname; ?>';" class="box">
  &nbsp;&nbsp;
  <input name="btnaddquestion" type="button" id="btnaddquestion" value="Add questions" onClick="window.location.href='index.php?view=addquestion&TopicId=<?php echo $detailTopicId; ?>&Topicname=<?php echo $detailTopicname; ?>';" class="box">
  &nbsp;&nbsp;
  <input name="btnBack" type="button" id="btnBack" value=" Back " onClick="window.history.back();" class="box">
 </p>
</form>
