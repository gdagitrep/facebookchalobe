<?php
if (!defined('WEB_ROOT')) {
	exit;
}
// make sure a subTopicId exists
if (isset($_GET['subTopicId']) && $_GET['subTopicId'] > 0) {
	$subtopicid_modify = $_GET['subTopicId'];
} else {
	// redirect to index.php if Course id is not present
	header('Location: index.php');}

// get subtopic info
$sql = "SELECT name, content FROM subtopics WHERE subt_id = '$subtopicid_modify'";
$result = mysql_query($sql) or die('Cannot get Subtopic. ' . mysql_error());
$row    = mysql_fetch_assoc($result);
extract($row);

$topicsList= dbquery("Select name as topic_name  from topics inner join topics_subtopics on 
    topics.topic_id= topics_subtopics.topic_id where subt_id= '$subtopicid_modify'")
or die('Cannot get Topics. ' . mysql_error());
?> 
<form action="processsubTopics.php?action=modifysubTopic&subTopicId=<?php echo $subtopicid_modify; ?>" method="post" enctype="multipart/form-data" name="frmmodifysubTopic" id="frmmodifysubTopic">
 <p align="center" class="formTitle">Modify Subtopic</p>
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">Included in Topics </td>
   <td class="content"> 
       <?php while( $row1=  dbFetchAssoc($topicsList)) {
           extract($row1 );?>
       <input type="checkbox" name="Topicsforsubtopicmodify[]" 
              value="<?php echo $topic_id;
              ?>" /><?php echo $topic_name;?><br>
	<?php } ?>
    </td>
  </tr>
  <tr> 
   <td width="150" class="label">Subtopic Name</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" value="<?php echo $name; ?>" size="50" maxlength="100"></td>
  </tr>
  <tr> 
   <td width="150" class="label">Content</td>
   <td class="content"> <textarea name="mtxContent" cols="70" rows="10" class="box" id="mtxDescription"><?php echo $content; ?></textarea></td>
  </tr>
    
 </table>
 <p align="center"> 
  <input name="btnModifyCourse" type="button" id="btnModifyCourse" value="Save changes" onClick="submit();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>