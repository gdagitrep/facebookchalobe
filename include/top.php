    
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
<!--<div id="login_box" >

<?php
//if (!isset($_SESSION['normal_user_id']))
//{ 
?>
<div class="buttons">
<a href="../user_login.php" class="button">Login</a>
</div>  div end of buttons
<?php 
//    }
//else{
?>
<div id="lgoutbox" style="border-color: #999;-moz-box-shadow: 0 2px 0 rgba(0, 0, 0, 0.2) ;-webkit-box-shadow:0 2px 5px rgba(0, 0, 0, 0.2);box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);height: 45px;width: 224px;position: absolute; background: white;top:50px">
<a href="../user_logout.php" class="button" style="float: right;">Logout</a>
</div>
<div class="buttons" style="float: right;">
<a  class="button close"> <?php //echo $_SESSION['normal_user_id'];?></a>
</div>  div end of buttons

<?php
//}?>

</div>-->
<div id="topbarfancy">
    <a style="display: inline-block; margin-left: 40px;width: 224px;height: 42px" href="/index.php" >
        <img src="../images/capua_new.png" style="height: 42px;"/>
    </a>
<div id="sidebarplusallcat" style="display: inline-block"
     
      >
    <div id="bla">
        <a><div id="allcat"></div></a>
    </div>
    <div id="chalopub2"></div>
    <div id="sidebar" style="<?php// if($nothome==1){?>display: none<?php //}?>" >

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
                    ?>
                    <div class="Universities-tab">
                    <a class="denapada2" <?php echo "href=\"$curl&su=4\""?>><?php echo "IIT Patna- MA 101"; ?></a></div>
                    <div class="Universities-tab">
                    <a class="denapada2" <?php echo "href=\"$curl&su=1\""?>><?php echo "IIT Bombay- MA 101"; ?></a> </div>
                </div>      
            </div>
            <?php
            }

            ?>  

        </div>
</div> <!-- end of sidebar  -->
</div> <!--end of sidebarplusallcat-->
<div id="progress_whole" style="margin-right: 10px; display:  inline">
    <div id="cart_button" 
         ><a>Show Progress</a></div>

    <div id="progress_dropdown">
        <div id="chalopub"></div>
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
<div id="loading_l" style="height: 1px;    background: #00F8FB;    position: fixed;    width: 0px;-webkit-transition: all 1s ease;">
</div>

    