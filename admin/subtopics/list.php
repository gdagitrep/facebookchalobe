<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// for paging
// how many rows to show per page
//$rowsPerPage = 100;

$sql = "SELECT subtopics.subt_id, subtopics.name,topics.topic_id, topics.name as tname FROM subtopics 
    left join topics_subtopics on topics_subtopics.subt_id=subtopics.subt_id 
    left join topics on topics.topic_id=topics_subtopics.topic_id order by topics_subtopics.topic_id,subtopics.subt_id;";
//$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
//$pagingLink = getPagingLink($sql, $rowsPerPage, '');
$result= dbQuery($sql);
?> 
<p>&nbsp;</p>
<form action="processsubTopics.php?action=addsubTopic" method="post"  name="frmListsubTopic" id="frmListsubTopic">
 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
 </table>
<br>
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>SubTopic Name</td>
<!--   <td width="75">Thumbnail</td>-->
   <td width="275">Topics</td>
  </tr>
  <?php
$parentId = 0;
if (dbNumRows($result) > 0) {
	$i = 0;
	
	while($row = dbFetchAssoc($result)) {
		extract($row);
		if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		
		$i += 1;
?>
  <tr class="<?php echo $class; ?>"> 
   <td><a href="index.php?view=detail&subTopicId=<?php echo $subt_id; ?>"><?php echo $name; ?></a></td>
   <td width="75" align="center"><a href="../topics/index.php?view=detail&TopicId=<?php echo $topic_id; ?>&TopicName=<?php echo $tname; ?>"><?php echo $tname; ?></a></td>
<!--   <td width="70" align="center"><a href="javascript:modifyTopic(<?php //echo $pd_id; ?>);">Modify</a></td>-->
<!--   <td width="70" align="center"><a href="javascript:deleteTopic(<?php //echo $pd_id; ?>, <?php //echo $catId; ?>);">Delete</a></td>-->
  </tr>
  <?php
	} // end while
?>
  <tr> 
   <td colspan="5" align="center">
   <?php 
echo $pagingLink;
   ?></td>
  </tr>
<?php	
} else {
?>
  <tr> 
   <td colspan="5" align="center">No subtopics Yet</td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
      
   <td colspan="5" align="right"><input name="btnAddTopic" type="button" id="btnAddTopic" value="Add Sub Topic and content" class="box" onClick="addsubTopic()"></td>
   
  </tr>
 </table>
 <p>&nbsp;</p>
</form>
