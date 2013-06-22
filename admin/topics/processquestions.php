<?php
require_once '../../library/config_admin.php';
require_once '../library/functions.php';

checkUser();

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
	
	
        case 'addquestion' :
		addquestion();
		break;
	case 'editquestion' :
		editquestion();
		break;	
	default :
	    // if action is not defined or unknown
		// move to main Topic page
		header('Location: index.php');
}

function addquestion(){
    if (isset($_GET['TopicId']) && $_GET['TopicId'] > 0) {
        
} else {
	// redirect to index.php if Topic id is not present
	header('Location: index.php');
}
    $questiontext=$_POST['txtquestiontext'];
    $qtype= 'O';//$_POST['qtype'];
    $aftersubtopic= $_POST['aftersubtopic'];
    $hint = $_POST['txthint'];
    $explanation= $_POST['txtexp'];
    $result= dbFetchAssoc(dbQuery("select max(Q_id) as s from questions"));
    $qid= $result['s']+1;
    if($qtype== 'O'){
        $ans= $_POST['correctans'];
    }
    if($qtype == 'S'){
        $ans= $_POST['correctansS'];
    }
    $result=  dbQuery("insert into questions (Q_id, subt_id,questiontext, type, answer, hint, solution) 
            values('$qid','$aftersubtopic','$questiontext','$qtype','$ans','$hint','$explanation') ")
         or die(mysql_error()) ;
    
    if($qtype== 'O'){
        $txtAoption= $_POST['txtAoption'];
        $txtBoption= $_POST['txtBoption'];
        $txtCoption= $_POST['txtCoption'];
        $txtDoption= $_POST['txtDoption'];
        $txtEoption= $_POST['txtEoption'];
        
        $result=  dbQuery("insert into answer_objective(Q_id, A,B,C,D,E)
            values ($qid, '$txtAoption','$txtBoption','$txtCoption','$txtDoption','$txtEoption')");
    }
    
    
    header("Location: index.php?view=detail&TopicId=". $_GET['TopicId']."&TopicName=".$_GET['Topicname']);
}


function editquestion(){
    if (isset($_GET['TopicId']) && $_GET['TopicId'] > 0) {
        $qid=$_GET['questionId'];
        $prevqtype= $_GET['Qtype'];
        
} else {
	// redirect to index.php if Topic id is not present
	header('Location: index.php');
}
    $newquestiontext=$_POST['txtquestiontext'];
    $newqtype= 'O';//$_POST['qtype'];
    $newaftersubtopic= $_POST['aftersubtopic'];
    $newhint = $_POST['txthint'];
    $newexplanation= $_POST['txtexp'];
    
    if($newqtype== 'O'){
        $ans= $_POST['correctans'];
    }
    if($newqtype == 'S'){
        $ans= $_POST['correctansS'];
    }
    $result=  dbQuery("update questions set subt_id='$newaftersubtopic',questiontext='$newquestiontext' , 
            type = '$newqtype', answer = '$ans', hint='$newhint', solution='$newexplanation' where Q_id= '$qid' ;") or die("question editing error".mysql_error()) ;
    
    if($newqtype== 'O'){
        $txtAoption= $_POST['txtAoption'];
        $txtBoption= $_POST['txtBoption'];
        $txtCoption= $_POST['txtCoption'];
        $txtDoption= $_POST['txtDoption'];
        $txtEoption= $_POST['txtEoption'];
        if($prevqtype=='O')
            $result=  dbQuery("update answer_objective set A='$txtAoption',B= '$txtBoption',C='$txtCoption',
                    D='$txtDoption',E='$txtEoption' where Q_id='$qid';") or die("2 error".mysql_error()) ;
        else
            $result=  dbQuery("insert into answer_objective(Q_id, A,B,C,D,E)
            values ($qid, '$txtAoption','$txtBoption','$txtCoption','$txtDoption','$txtEoption')") or die("3 error".mysql_error()) ;
    }
    if($newqtype=='S' && $prevqtype =='O')
        $result=  dbQuery("delete from answer_objective where Q_id='$qid';") or die("4 error".mysql_error()) ;
    
    
    header("Location: index.php?view=detail&TopicId=". $_GET['TopicId']."&TopicName=".$_GET['Topicname']);
}


?>