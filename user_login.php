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
                        <img src="images/abc.png" alt="Site Title" height="42px"/>
                    <span>Learn with Passion</span>
                </a></h1>
            </div>
    </div>

         <form method="post" name="frmLoginuser" id="frmLoginuser">
<!--       <p>&nbsp;</p>-->
       <table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#336699" class="entryTable">
        <tr id="entryTableHeaderuser">
         <td>:: User Login ::</td>
        </tr>
        <tr> 
         <td class="contentArea"> 
		 <div class="errorMessage" align="center"><?php echo $errorMessage; ?></div>
		  <table width="100%" border="0" cellpadding="2" cellspacing="1" class="text">
           <tr align="center"> 
            <td colspan="3">&nbsp;</td>
           </tr>
            <tr> 
               <td colspan="2" align="right">Admin Access</td>
            <td><div id="admin_box" >
                <div class="buttons" >
                <a href="../admin/index.php" class="button">Admin</a>
                </div> 
                </div>
            </td>
            </tr>
           <tr> 
               <td colspan="2" align="right">Not registered yet?</td>
            <td><div class="buttons"><a href="../user_register.php" class="button">Register</a></div></td>
           </tr>
           <tr class="text"> 
            <td width="100" align="right">User Name</td>
            <td width="10" align="center">:</td>
            <td><input name="txtnormalUserName" type="text" class="box" id="txtnormalUserName" value="" size="30" maxlength="50"></td>
           </tr>
           <tr> 
            <td width="100" align="right">Password</td>
            <td width="10" align="center">:</td>
            <td><input name="txtnormalPassword" type="password" class="box" id="txtnormalPassword" value="" size="30"></td>
           </tr>
           <tr> 
            <td colspan="2">&nbsp;</td>
            <td><input name="btnnormalLogin" type="submit" class="box" id="btnnormalLogin" value="Login"></td>
           </tr>
          </table></td>
        </tr>
       </table>
       <p>&nbsp;</p>
      </form>
<p>&nbsp;</p>
</body>
</html>
