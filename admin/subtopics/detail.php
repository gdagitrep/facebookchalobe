<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a Subtopic id exists
if (isset($_GET['subTopicId']) && $_GET['subTopicId'] > 0) {
	$detailsubTopicId = $_GET['subTopicId'];
} else {
	// redirect to index.php if Course id is not present
	header('Location: index.php');
}

$sql = "SELECT `name`,content  FROM subtopics WHERE subt_id = $detailsubTopicId";
$result = mysql_query($sql) or die('Cannot get Course. ' . mysql_error());

$row = mysql_fetch_assoc($result);
extract($row);
$sql = "select name as tname from topics where topic_id =(select topic_id from topics_subtopics where subt_id = $detailsubTopicId)";
$result = mysql_query($sql) or die('Cannot get Course. ' . mysql_error());

$row = mysql_fetch_assoc($result);
extract($row);
?>
<p>&nbsp;</p>
<form action="processsubTopics.php?action=modifysubTopic" method="post" enctype="multipart/form-data" name="frmmodifysubTopic" id="frmmodifysubTopic">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Course Name</td>
   <td class="content"> <?php echo $name; ?></td>
  </tr>
  <tr> 
   <td width="150" class="label">Included in Topic</td>
   <td class="content"><?php echo $tname ?></td>
  </tr>
  <tr> 
   <td width="150" class="label">Content</td>
   <td class="content"><?php 
   //echo nl2br($content, true); 
   echo $content;
   ?> </td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnmodifysubTopic" type="button" id="btnmodifysubTopic" value="Modify Subtopic" onClick="window.location.href='index.php?view=modify&subTopicId=<?php echo $detailsubTopicId; ?>';" class="box">
  &nbsp;&nbsp;
  <input name="btnBack" type="button" id="btnBack" value=" Back " onClick="window.history.back();" class="box">
 </p>
</form>
