<?php
require_once 'library/config.php';

$_SESSION['shop_return_url'] = $_SERVER['REQUEST_URI'];
if (isset($_GET['logout'])) 
    us_doLogout();
	
//also change the name of the page title in header.php
$course  = (isset($_GET['c']) && $_GET['c'] != '') ? $_GET['c'] : 0;  /*corresponds to the category id shown by the current page link */
//$university  = (isset($_GET['u']) && $_GET['u'] != '') ? $_GET['u'] : 0;
$subuniversity= (isset($_GET['su']) && $_GET['su'] != '') ? $_GET['su'] : 0;

if ($course!=0 || $subuniversity != 0)
    $nothome=1;
require_once 'include/header.php';

?>
<body 
<div id="wrapper">
	
    <?php     
    require_once 'include/top.php';
    if($course!=0)
        require_once 'include/leftNavv.php';
    require_once 'include/content.php';
    ?>
    
   

</div> <!-- end of wrapper -->
</body>
<?php
//require_once 'include/footer.php';
?>

