<?php
if (!defined('WEB_ROOT')) {
	exit;
}

if (isset($_GET['catId']) && (int)$_GET['catId'] >= 0) {
	$catId = (int)$_GET['catId'];
	$queryString = "&catId=$catId";
} else {
	$catId = 0;
	$queryString = '';
}
	
// for paging
// how many rows to show per page
$rowsPerPage = 5;

$sql = "SELECT SU_id, name
        FROM universities
		ORDER BY SU_id";
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($sql, $rowsPerPage);
?>
<p>&nbsp;</p>
<form action="processCategory.php?action=addCategory" method="post"  name="frmListCategory" id="frmListCategory">
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>Category Name</td>
   <td width="75">Modify</td>
   <td width="75">Delete</td>
  </tr>
  <?php
$cat_parent_id = 0;
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
		
			$cat_name = "<a href=\"index.php?catId=$SU_id\">$name</a>";
		
			
?>
  <tr class="<?php echo $class; ?>"> 
   <td><?php echo $cat_name; ?></td>
   <td width="75" align="center"><a href="javascript:modifyCategory(<?php echo $cat_id; ?>);">Modify</a></td>
   <td width="75" align="center"><a href="javascript:deleteCategory(<?php echo $cat_id; ?>);">Delete</a></td>
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
   <td colspan="5" align="center">No Categories Yet</td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"> <input name="btnAddCategory" type="button" id="btnAddCategory" value="Add Universities" class="box" onClick="addCategory(<?php echo $catId; ?>)"> 
   </td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>