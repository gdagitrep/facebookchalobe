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
<?php
$key = 'kahajaogebeta';
$string = '1'; // note the spaces

$encrypted = encrypt($string);
$decrypted = decrypt($encrypted);

echo 'Encrypted:' . "\n";
var_dump($encrypted);

echo "\n";

echo 'Decrypted:' . "\n";
var_dump($decrypted); // spaces are preserved

echo "\n".$course;
?>
   </div>
    </div>
    