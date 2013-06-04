    
<script>
    var nothome=0;
    <?php if($nothome ==1){ ?>
        nothome=1;
    <?php }?>
function showsidebar(){
   jQuery('#sidebar').css('display', 'block');
}
function hidesidebar(){
    jQuery('#sidebar').css('display', 'none');
}
</script>
<div id="topmost_header">
    <div id="header">
        <div class="right"></div>
        <h1><a href="index.php">
        <img src="images/abc.png" alt="Site Title" height="42px"/>
        <span>Let's learn by Doing</span>
        </a></h1>
    </div>
	

<div id="login_box" >

<?php
$_SESSION['normal_login_return_url'] = $_SERVER['REQUEST_URI'];
if(isset($_SESSION['normal_uid']))
    $uidphp=$_SESSION['normal_uid'];
else
    $uidphp='notknown';
if (!isset($_SESSION['normal_user_id']))
{  //$_SESSION['normal_login_return_url'] = $_SERVER['REQUEST_URI'];
?>
<div class="buttons">
<a href="../user_login.php" class="button">Login</a>
</div> <!-- div end of buttons-->
<?php }
else{
?>
<div id="lgoutbox" style="border-color: #999;-moz-box-shadow: 0 2px 0 rgba(0, 0, 0, 0.2) ;-webkit-box-shadow:0 2px 5px rgba(0, 0, 0, 0.2);box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);height: 45px;width: 224px;position: absolute; background: white;top:50px">
<a href="../user_logout.php" class="button" style="float: right;">Logout</a>
</div>
<div class="buttons" style="float: right;">
<a  class="button close"> <?php echo $_SESSION['normal_user_id'];?></a>
</div> <!-- div end of buttons-->

<?php
}?>

</div>
<div id="admin_box" >
    <div class="buttons" >
    <a href="../admin/index.php" class="button">Admin</a>
    </div> 
</div>
<div id="topbarfancy">
<div id="sidebarplusallcat" style="position: absolute;"
     onmouseout= "if(nothome==1){jQuery(hidesidebar());}"
     onmouseover="if(nothome==1){jQuery(showsidebar())}"
      >
    <div id="allcat" 
         onmouseover="jQuery(this).css('background', 'black')" onmouseout="jQuery(this).css('background', 'transparent');">COURSES</div>
    <div id="sidebar" style="<?php if($nothome==1){?>display: none<?php }?>" >

        <div class="sidebar_section">
        <?php 
            $sql = "SELECT * FROM courses ORDER BY name";
            $result0 = dbQuery($sql);
            while ($row = dbFetchAssoc($result0)) {

            extract($row);
            $cname= $name; $curl=$_SERVER['PHP_SELF'] . '?c=' . $course_id;
            ?>
            <div class="Courses-tab">

            <a class="denapada" href="<?php echo $curl; ?>"><?php echo " $cname"; ?></a>
                <div class="popout_all">
                <?php 
                echo $cname.' taught at:';
//                    $sql = "SELECT u_id, name FROM edc_universities ORDER BY u_id";
//                    $result = dbQuery($sql);     
//                    while ($row = dbFetchAssoc($result)) {
//                    extract($row);
//                    $uurl= $burl.'&u=' .$u_id; 
//                    $uname  = $name; //university name and url //IIT,NIT ,State Univetc
                    ?>
                    <div class="Universities-tab">
                    <a class="denapada2" <?php echo "href=\"$curl&su=4\""?>><?php echo "IIT Patna"; ?></a></div>
                    <div class="Universities-tab">
                    <a class="denapada2" <?php echo "href=\"$curl&su=1\""?>><?php echo "IIT Bombay"; ?></a> </div>
<!--                    <div class="popout_all-subuni">-->
                    <?php
//                    if($uname =="IIT")
//                        $sql = "SELECT SU_id, name FROM edc_IITs ORDER BY Name";
//                    if($uname =="NIT")
//                        $sql = "SELECT SU_id, name FROM edc_NITs ORDER BY Name";
//                    $result2 = dbQuery($sql);
//                    while ($row2 = dbFetchAssoc($result2)) {
//                    extract($row2);
//                    $SU_name=$name; $SU_url= $uurl.'&su='.$name;
                    ?>
<!--                        <div class ="Sub-Univ-tab">
                        <a class="denapada2" 
                            <?php //echo "href=\"$SU_url\""?>><?php// echo " $SU_name"; ?></a>
                        <div class="popout_all-click">
                            <a class="denapada2" <?php // echo "href=\"$SU_url\""?>>"Click to see courses of all Semesters</a>
                        </div>
                        </div>-->

                    <?php// }?>
<!--                    </div>
                    </div>-->
                    <?php
                    //}

                ?>

                </div>      
            </div>
            <?php
            }

            ?>  

        </div>
</div> <!-- end of sidebar  -->
</div> <!--end of sidebarplusallcat-->
<div id="progress_whole" style="float:right"><div id="cart_button" onmouseover="jQuery(this).css('background', 'black')"  onmouseout="jQuery(this).css('background', 'transparent')">Show Progress</div>

    <div id="progress_dropdown"><div id="chalopub" style="background-image: url('images/Prx8lfwH0A8.png')"></div>
        <div id="dropdown_content">
            <?php
            if (!isset($_SESSION['normal_user_id']))
            {?><div id="notloggedin"><a href="../user_login.php">
                <?php
                echo "Log in to save your progress";
                ?>
            </a></div>
            <?php
            }
            ?>

            <div style="background-image: url('images/380.gif');position: relative;
            min-height: 50px;
            background-repeat: no-repeat;
            top: 40px;
            left: 80px;width: 65px"></div>
            <?php require_once 'include/progress.php' ?>
        </div>
    </div>

</div></div><?php //echo "pd"?>    
</div> <!-- end of topmost_header -->

    