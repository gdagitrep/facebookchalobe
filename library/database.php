<?php
if($admin8723nh89h3289h2939h9h== 1){
require_once 'config_admin.php';}
else{
   //require_once 'config.php'; 
    //// database connection config
    $dbHost = 'localhost';
    $dbUser = 'normal0_user';
    $dbPass = 'lala';//3e0dae209jjGi120jdf_#9120j0';
    $dbName = 'education';

    // setting up the web root and server root for
    // this shopping cart application
    $thisFile = str_replace('\\', '/', __FILE__);
    $docRoot = $_SERVER['DOCUMENT_ROOT'];

    $webRoot  = str_replace(array($docRoot, 'library/config.php'), '', $thisFile);
    $srvRoot  = str_replace('library/config.php', '', $thisFile);

    define('WEB_ROOT', $webRoot);
    define('SRV_ROOT', $srvRoot);
}


$dbConn = mysql_connect ($dbHost, $dbUser, $dbPass) or die ('MySQL connect failed. ' . mysql_error());
mysql_select_db($dbName) or die('Cannot select database. ' . mysql_error());

function dbQuery($sql)
{
	$result = mysql_query($sql) or die(mysql_error());
	
	return $result;
}

function dbAffectedRows()
{
	global $dbConn;
	
	return mysql_affected_rows($dbConn);
}

function dbFetchArray($result, $resultType = MYSQL_NUM) {
	return mysql_fetch_array($result, $resultType);
}

function dbFetchAssoc($result)
{
	return mysql_fetch_assoc($result);
}

function dbFetchRow($result) 
{
	return mysql_fetch_row($result);
}

function dbFreeResult($result)
{
	return mysql_free_result($result);
}

function dbNumRows($result)
{
	return mysql_num_rows($result);
}

function dbSelect($dbName)
{
	return mysql_select_db($dbName);
}

function dbInsertId()
{
	return mysql_insert_id();
}
?>