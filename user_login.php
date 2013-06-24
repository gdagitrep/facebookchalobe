<?php
require_once 'library/config.php';
require_once 'library/login-functions.php';
$errorMessage = '&nbsp;';
if (isset($_POST['txtnormalUserName'])) {
	$result = us_doLogin();	
	if ($result != '') {
		$errorMessage = $result;
	}
}
?>
<html>
<head>
<title>CourseSpree - Login/Register</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="stylesheet/userlogin.css" rel="stylesheet" type="text/css">
<link href="stylesheet/demo.css" rel="stylesheet" type="text/css">
</head>
<body >
    <div id="templatemo_header_bar">
            
            <div id="header"><div class="right"></div>
            
                <h1><a href="index.php">
                        <img src="images/sparta.png" alt="Site Title" height="42px"/>
                    <span>Learn with Passion</span>
                </a></h1>
            </div>
    </div>

<form method="post" name="frmLoginuser" id="frmLoginuser">
    <h2 class="form-signin-heading" style="font-size: 31.5px;">Please sign in</h2>
    <div class="errorMessage" align="center"><?php echo $errorMessage; ?></div>
    
           
    <input name="txtnormalUserName" type="text" class="box" id="txtnormalUserName" placeholder="Email address">
            
    <input name="txtnormalPassword" type="password" class="box" id="txtnormalPassword" placeholder="Password" >
    <input name="btnnormalLogin" type="submit" class="box" id="btnnormalLogin" value="Login">
       <p>&nbsp;</p>
      </form>
<p>&nbsp;</p>

Admin Access
    <div id="admin_box" >
    <div class="buttons" >
    <a href="../admin/index.php" class="button">Admin</a>
    </div> 
    </div>
    Not registered yet?
    <div class="buttons"><a href="../user_register.php" class="button">Register</a></div>
</body>
</html>
