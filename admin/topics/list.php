<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// for paging
// how many rows to show per page
$rowsPerPage = 100;

$sql = "SELECT topic_id, name FROM topics ORDER BY name";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage, '');

?> 
<p>&nbsp;</p>
<form action="processTopics.php?action=addTopic" method="post"  name="frmListTopic" id="frmListTopic">
 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
 </table>
<br>
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>Topic Name</td>
<!--   <td width="75">Thumbnail</td>-->
   <td width="275">Courses</td>
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
   <td><a href="index.php?view=detail&TopicId=<?php echo $topic_id; ?>&TopicName=<?php echo $name; ?>"><?php echo $name; ?></a></td>
   <td width="75" align="center"><a href="?c=<?php echo $cat_id."baadmaibanayenge"; ?>"><?php echo $cat_name; ?></a></td>
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
   <td colspan="5" align="center">No Topics Yet</td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
      
   <td colspan="5" align="right"><input name="btnAddTopic" type="button" id="btnAddTopic" value="Add Topic" class="box" onClick="addTopic()"></td>
   
  </tr>
 </table>
 <p>&nbsp;</p>
</form>
