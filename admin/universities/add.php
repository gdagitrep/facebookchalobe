<?php
if (!defined('WEB_ROOT')) {
	exit;
}
?> 

<form action="processUniversity.php?action=add" method="post" enctype="multipart/form-data" name="frmUniversity" id="frmUniversity">
 <p align="center" class="formTitle">Add Universities</p>
 
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">University Name</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" size="30" maxlength="50"></td>
  </tr>  
 </table>
 <p align="center"> 
  <input name="btnAddUniversity" type="button" id="btnAddUniversity" value="Add University" onClick="checkUniversityForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>