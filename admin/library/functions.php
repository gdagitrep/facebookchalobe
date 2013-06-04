<?php

/*
	Check if a session user id exist or not. If not set redirect
	to login page. If the user session id exist and there's found
	$_GET['logout'] in the query string logout the user
*/
function checkUser()
{
	// if the session id is not set, redirect to login page
	if (!isset($_SESSION['plaincart_user_id'])) {
		header('Location: ' . WEB_ROOT . 'admin/login.php');
		exit;
	}
	
	// the user want to logout
	if (isset($_GET['logout'])) {
		doLogout();
	}
}

/*
	
*/
function doLogin()
{
	// if we found an error save the error message in this variable
	$errorMessage = '';
	
	$userName = $_POST['txtUserName'];
	$password = $_POST['txtPassword'];
	
	// first, make sure the username & password are not empty
	if ($userName == '') {
		$errorMessage = 'You must enter your username';
	} else if ($password == '') {
		$errorMessage = 'You must enter the password';
	} else {
		// check the database and see if the username and password combo do match
		$sql = "SELECT user_id
		        FROM editors 
				WHERE user_name = '$userName' AND user_password = '$password'";
		$result = dbQuery($sql);
	
		if (dbNumRows($result) == 1) {
			$row = dbFetchAssoc($result);
			$_SESSION['plaincart_user_id'] = $row['user_id'];
			
			// log the time when the user last login
			$sql = "UPDATE editors 
			        SET user_last_login = NOW() 
					WHERE user_id = '{$row['user_id']}'";
			dbQuery($sql);

			// now that the user is verified we move on to the next page
            // if the user had been in the admin pages before we move to
			// the last page visited
			if (isset($_SESSION['login_return_url'])) {
				header('Location: ' . $_SESSION['login_return_url']);
				exit;
			} else {
				header('Location: index.php');
				exit;
			}
		} else {
			$errorMessage= 'Wrong username or password';
			
		}		
			
	}
	
	return $errorMessage;
}

/*
	Logout a user
*/
function doLogout()
{
	if (isset($_SESSION['plaincart_user_id'])) {
		unset($_SESSION['plaincart_user_id']);
		session_unregister('plaincart_user_id');
	}
		                    

	header('Location: login.php');
	exit;
}

                    


function yoyo($arrayy,$pid, $selectedid,$shift)
{
    $list='';
    $parents= $arrayy[$pid];
    foreach ($parents as $parent) {
            $name     = $parent['name'];
            $id = $parent['id'];

            $list .= "<option value=\"$id\"";
            if($id==$selectedid){
                $list.= " selected";
            }
			
            $list .= ">$shift $name</option>\r\n";
            if(!empty($arrayy[$id]))
            {
                $list .= yoyo($arrayy, $id, $selectedid,$shift."&nbsp;&nbsp;");
            }
    

            
    }
	
	return $list;
}
?>
