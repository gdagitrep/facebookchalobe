<?php
/*
	Check if a session user id exist or not. If not set redirect
	to login page. If the user session id exist and there's found
	$_GET['logout'] in the query string logout the user
*/
function us_checkUser()
{
	// if the session id is not set, redirect to login page
	if (!isset($_SESSION['normal_user_id'])) {
		header('Location: ' . WEB_ROOT . 'user_login.php');
		exit;
	}
	
	// the user want to logout
	if (isset($_GET['logout'])) {
		us_doLogout();
	}
}

function us_register()
{
    // if we found an error save the error message in this variable
    $errorMessage = '';
    $normaluserNamereg = htmlspecialchars(htmlentities ($_POST['txtnormalUserNamereg']));
    $normalpasswordreg = $_POST['txtnormalPasswordreg'];
    // first, make sure the username & password are not empty
	if ($normaluserNamereg == '') {
		$errorMessage = 'You must enter your email id';
	} else if ($normalpasswordreg == '') {
		$errorMessage = 'You must enter a password';
	} else {
            $normaluserNamereg=filter_var( $normaluserNamereg, FILTER_VALIDATE_EMAIL );
            if(!$normaluserNamereg)
                $errorMessage='Email address is not valid';
            else{
            //check if already exists
            $sql = "SELECT emailaddress FROM users 
            WHERE emailaddress = '$normaluserNamereg' ";//AND passwd = '$normalpasswordreg'
            $result = dbQuery($sql);
            if (dbNumRows($result) == 1) {
            $row = dbFetchAssoc($result);
            if($row !='')
                $errorMessage= 'Already registered';
            }
            else{
            //create new entry in tbl_customer
            $sql = "INSERT INTO users (emailaddress,user_password,user_regdate,user_last_login)
                    VALUES ('$normaluserNamereg' ,'$normalpasswordreg', NOW(), NOW()) ";
            dbQuery($sql);
            
            //now login with same id
            $_SESSION['normal_user_id'] = $row['emailaddress'];
            //$_SESSION['normal_uid'] = $row['uid'];
            
            //redirect back to initial page
            if (isset($_SESSION['normal_login_return_url'])) {
				header('Location: ' . $_SESSION['normal_login_return_url']);
				exit;
			} else {
				header('Location: index.php');
				exit;
			}
            }
        }}
        return $errorMessage;
}

/*
	
*/
function us_doLogin()
{
	// if we found an error save the error message in this variable
	$errorMessage = '';
	
	$normaluserName = htmlspecialchars(htmlentities ($_POST['txtnormalUserName']));
	$normalpassword = $_POST['txtnormalPassword'];
	
	// first, make sure the username & password are not empty
	if ($normaluserName == '') {
		$errorMessage = 'You must enter your username';
	} else if ($normalpassword == '') {
		$errorMessage = 'You must enter the password';
	} else {
            $normaluserName=filter_var( $normaluserName, FILTER_VALIDATE_EMAIL );
            if(!$normaluserName)
                $errorMessage='Email address is not valid';
            else{
		// check the database and see if the username and password combo do match
		$sql = "SELECT user_id,emailaddress
		        FROM users 
				WHERE emailaddress = '$normaluserName' AND user_password = '$normalpassword'";
		$result = dbQuery($sql);
	
		if (dbNumRows($result) == 1) {
			$row = dbFetchAssoc($result);
			$_SESSION['normal_user_id'] = $row['emailaddress'];
			$_SESSION['normal_uid'] = $row['user_id'];
			// log the time when the user last login
			$sql = "UPDATE users 
			        SET user_last_login = NOW() 
					WHERE emailaddress = '{$row['emailaddress']}'";
			dbQuery($sql);

			// now that the user is verified we move on to the next page
            // if the user had been in the admin pages before we move to
			// the last page visited
			if (isset($_SESSION['normal_login_return_url'])) {
				header('Location: ' . $_SESSION['normal_login_return_url']);
				exit;
			} else {
				header('Location: index.php');
				exit;
			}
		} else {
			$errorMessage= 'Wrong username or password';
			
		}		
			
	}}
	
	return $errorMessage;
}

/*
	Logout a user
*/
function us_doLogout()
{
	if (isset($_SESSION['normal_user_id'])) {
		unset($_SESSION['normal_user_id']);
		session_unregister('normal_user_id');
	}
	if (isset($_SESSION['normal_login_return_url'])) {
            header('Location: ' . $_SESSION['normal_login_return_url']);
            exit;
        } else {
                header('Location: index.php');
                exit;
        }

}


/*
	Create the paging links
*/
function getPagingNav($sql, $pageNum, $rowsPerPage, $queryString = '')
{
	$result  = mysql_query($sql) or die('Error, query failed. ' . mysql_error());
	$row     = mysql_fetch_array($result, MYSQL_ASSOC);
	$numrows = $row['numrows'];
	
	// how many pages we have when using paging?
	$maxPage = ceil($numrows/$rowsPerPage);
	
	$self = $_SERVER['PHP_SELF'];
	
	// creating 'previous' and 'next' link
	// plus 'first page' and 'last page' link
	
	// print 'previous' link only if we're not
	// on page one
	if ($pageNum > 1)
	{
		$page = $pageNum - 1;
		$prev = " <a href=\"$self?page=$page{$queryString}\">[Prev]</a> ";
	
		$first = " <a href=\"$self?page=1{$queryString}\">[First Page]</a> ";
	}
	else
	{
		$prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
		$first = ' [First Page] '; // nor 'first page' link
	}
	
	// print 'next' link only if we're not
	// on the last page
	if ($pageNum < $maxPage)
	{
		$page = $pageNum + 1;
		$next = " <a href=\"$self?page=$page{$queryString}\">[Next]</a> ";
	
		$last = " <a href=\"$self?page=$maxPage{$queryString}{$queryString}\">[Last Page]</a> ";
	}
	else
	{
		$next = ' [Next] ';      // we're on the last page, don't enable 'next' link
		$last = ' [Last Page] '; // nor 'last page' link
	}
	
	// return the page navigation link
	return $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 
}
?>
