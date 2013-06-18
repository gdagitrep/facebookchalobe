<?php
if (!defined('WEB_ROOT')) {
	exit;
}
$sql = "SELECT topic_id, name FROM topics ORDER BY topic_id";
	$topicsList = dbQuery($sql) or die('Cannot get Topics. ' . mysql_error());
?> 
<p>&nbsp;</p>
<!--9885411911 -->
<form action="processsubTopics.php?action=addsubTopic" method="post" enctype="multipart/form-data" name="frmAddsubTopic" id="frmAddsubTopic">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr><td colspan="2" id="entryTableHeader">Add Sub Topic</td></tr>
  <tr> 
   <td width="150" class="label">Included in Topics</td>
   <td class="content">
       <fieldset id="checkArray">
       <?php while( $row1=  dbFetchAssoc($topicsList)) {
           extract($row1 );?>
       <input type="checkbox" name="Topicsforsubtopic[]" 
              value="<?php echo $topic_id;
              ?>" /><?php echo $name;?><br>
	<?php } ?>
       </fieldset>
    </td>
  </tr>
  <tr> 
   <td width="150" class="label">Sub Topic Name</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" size="50" maxlength="100"></td>
  </tr>
  <tr> 
   <td width="150" class="label">Content</td>
   <td class="content"> 
       <!-- Place this in the body of the page content -->
<!--<form method="post">-->
<textarea name="txtcontent" >Yo yo</textarea>
<!--</form>-->
<!--       <input name="txtName" type="text" class="box" id="txtName" size="50" maxlength="100">-->
   </td>
  </tr>
  
 </table>
 <p align="center"> 
  <input name="btnAddSubTopic" type="button" id="btnAddSubTopic" value="Add Sub Topic and Content" onClick="checkAddSubtopicForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>
