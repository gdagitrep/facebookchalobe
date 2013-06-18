<?php
require_once 'library/config.php';
require_once 'library/login-functions.php';
$errorMessage = '&nbsp;';
if (isset($_POST['txtnormalUserNamereg'])) {
	$result = us_register();	
	if ($result != '') {
		$errorMessage = $result;
	}
}
?>
<html>
<head>
<title>CourseLamp User - Register</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="stylesheet/userlogin.css" rel="stylesheet" type="text/css">
<link href="stylesheet/demo.css" rel="stylesheet" type="text/css">
</head>
<body style="background: url(images/templatemo_body_checkout.png) repeat-x">
    <div id="templatemo_header_bar">
            
            <div id="header"><div class="right"></div>
            
                <h1><a href="index.php">
                        <img src="images/abc.png" alt="Site Title" height="42px"/>
                    <span>Learning with Passion</span>
                </a></h1>
            </div>
    </div>
 <form method="post" name="frmLoginuser" id="frmRegisteruser">
       <p>&nbsp;</p>
       <table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#336699" class="entryTable">
        <tr id="entryTableHeaderuser">
         <td>:: User Register ::</td>
        </tr>
        <tr> 
         <td class="contentArea"> 
		 <div class="errorMessage" align="center"><?php echo $errorMessage; ?></div>
		  <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
           <tr align="center"> 
            <td colspan="3">&nbsp;</td>
           </tr>
           <tr class="text"> 
            <td width="100" align="right">Email</td>
            <td width="10" align="center">:</td>
            <td><input name="txtnormalUserNamereg" type="text" class="box" id="txtnormalUserNamereg" value="" size="30" maxlength="50"></td>
           </tr>
           <tr> 
            <td width="100" align="right">New Password</td>
            <td width="10" align="center">:</td>
            <td><input name="txtnormalPasswordreg" type="password" class="box" id="txtnormalPasswordreg" value="" size="30"></td>
           </tr>
           <tr> 
            <td colspan="2">&nbsp;</td>
            <td><input name="btnnormalLoginreg" type="submit" class="box" id="btnnormalsignup" value="SignUp"></td>
           </tr>
          </table></td>
        </tr>
       </table>
       <p>&nbsp;</p>
      </form>
</body>
</html>
