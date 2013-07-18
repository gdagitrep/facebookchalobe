<?php
require_once 'library/config.php';
$_SESSION['shop_return_url'] = $_SERVER['REQUEST_URI'];
if (isset($_GET['logout'])) 
    us_doLogout();
	
//also change the name of the page title in header.php
$course  = (isset($_GET['c']) && $_GET['c'] != '') ? decrypt($_GET['c']) : 0;  /*corresponds to the category id shown by the current page link */
//$university  = (isset($_GET['u']) && $_GET['u'] != '') ? $_GET['u'] : 0;
$subuniversity= (isset($_GET['su']) && $_GET['su'] != '') ? decrypt($_GET['su']) : 0;
$subtopicid= (isset($_GET['st']) && $_GET['st'] != '') ? decrypt($_GET['st']) : 0;

if ($course!=0 || $subuniversity != 0)
    $nothome=1;
require_once 'include/header.php';

$_SESSION['normal_login_return_url'] = $_SERVER['REQUEST_URI'];
if(isset($_SESSION['normal_uid']))
    $uidphp=$_SESSION['normal_uid'];
else
    $uidphp='notknown';
?>
<body>
	
    <?php
    require_once 'include/top.php';
    if($nothome !=1){ ?>
        <div style="background: url('/images/2020485686.jpg');width: 100%;margin-top: -23%;
height: 810px;
background-repeat: no-repeat;
min-width: 100%;
background-size: cover;"></div>
    <?php }?>
<script language="javascript" type="text/javascript" >inc_loadingL_w('20');</script>
<div id="wrapper">
    <?php 
    if($nothome !=1){ 
        require_once 'include/picturization2.php'; 
    }
    
    if($course!=0){
        require_once 'include/leftNavv.php';
    ?>
    <script language="javascript" type="text/javascript" >inc_loadingL_w('60');</script>
    <?php
    if($subtopicid==0)
        require_once 'include/picturization.php';
    else
        require_once 'include/content.php';
    ?>
    <?php
        }?>
<script language="javascript" type="text/javascript" >inc_loadingL_w('90');</script>
</div> <!-- end of wrapper -->
</body>
<?php
    require_once 'include/footer.php';
?>
<script language="javascript" type="text/javascript" >inc_loadingL_w('100');
document.getElementById('loading_l').style.background='rgba(255,255,255,0.32)'; </script>

