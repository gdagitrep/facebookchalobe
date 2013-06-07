<?php 
require_once '../library/database.php'; 
//echo "Jai Shri Ram";
$uidphp=$_GET['uid'];
$Q_id= $_GET['QID'];
$N= $_GET['N'];

$ret=array();
$action = isset($_GET['action']) ? $_GET['action'] : '';
$sel= isset($_GET['sel']) ? $_GET['sel'] : '-1';
if($action=='getq'){
    $ret[0]="<table>";   
    $sql= "select questiontext,type, marks from questions where Q_id='$Q_id';";
    $result1= dbQuery($sql) or die('Cannot get questions. ' . mysql_error());
      extract(mysql_fetch_assoc($result1));

    $ret[0]=$ret[0]."<tr><td style=\"float: left; width: 40px\"><b>Q.".$N.".</b></td> <td colspan=\"2\">".$questiontext."</td></tr>";

    if($type=='O'){
        $sql= "select A,B,C,D,E from answer_objective where Q_id='$Q_id';";
        $result2= dbQuery($sql) or die('Cannot get options. ' . mysql_error());
        extract(mysql_fetch_assoc($result2));
        $ret[0]=$ret[0]."<tr><td>   </td><td> <input type=\"radio\" value=\"A\" name= \"corans\" onchange=\"changegr();\" /></td><td><b>".$A."</b></td></tr>";
        $ret[0]=$ret[0]."<tr><td>   </td><td> <input type=\"radio\" value=\"B\" name= \"corans\" onchange=\"changegr();\" /></td><td>".$B."</td></tr>";
        $ret[0]=$ret[0]."<tr><td>   </td><td> <input type=\"radio\" value=\"C\" name= \"corans\" onchange=\"changegr();\" /></td><td>".$C."</td></tr>";
        $ret[0]=$ret[0]."<tr><td>   </td><td> <input type=\"radio\" value=\"D\" name= \"corans\" onchange=\"changegr();\" /></td><td>".$D."</td></tr>";
        $ret[0]=$ret[0]."<tr><td>   </td><td> <input type=\"radio\" value=\"E\" name= \"corans\" onchange=\"changegr();\" /></td><td>".$E."</td></tr>";
            }
    $ret[0]=$ret[0]."</table>";
    
    //for known user
    //$ret : 
    //1 -> 0 for question record not in db, 1 for opposite
    //2 -> wronged(1) or not (0)
    //3 -> hinted (1) or not (0)
    //4 -> completed (1) or not (0)
    //5 -> score -- left after all kind of deductions for every wrong action/ hint action/ 
                    //or 0 if two wrong tries have been exhausted
    
    if($uidphp!='notknown'){
        $sql="select wronged, hinted, completed, score from users_ques where u_id='$uidphp' and Q_id='$Q_id';";
        $result=dbQuery($sql) or die('Cannot get questions '.mysql_error());
        if(mysql_num_rows($result)>0){
            $ret[1]="1";
            extract(mysql_fetch_assoc($result));
            $ret[2]=$wronged;$ret[3]=$hinted;$ret[4]=$completed;$ret[5]=$score;
        }
        else{
            $ret[1]="0";
            $ret[5]= $marks;
        }
    }else{ //i.e. user is not known
    
        //5 -> score (default as derived from questions table)
        $ret[5]= $marks;
    }
}
if($action=='geta'){
    if($uidphp!='notknown'){
        $sql="select wronged, hinted, completed, score  from users_ques where u_id='$uidphp' and Q_id='$Q_id';";
        $result=dbQuery($sql) or die('Cannot get questions. ' . mysql_error())    ;
        if(mysql_num_rows($result)>0){
            $ret[1]="1";
            extract(mysql_fetch_assoc($result));
            $ret[2]=$wronged;$ret[3]=$hinted;$ret[4]=$completed;$ret[5]=$score;
        }
        else
            $ret[1]="0";
    }
    $sql= "select answer from questions where Q_id='$Q_id';";
    $result1= dbQuery($sql) or die('Cannot get answer. ' . mysql_error())    ;
    extract(mysql_fetch_assoc($result1));
    if($sel!= -1 && $sel== $answer)
        $ret[0]=1;
    else
        $ret[0]=0;
}
if($action=='getquserdetails'){ // get question stats for user (known user)
    if($uidphp!='notknown'){
        $sql="select wronged, hinted, completed, score from users_ques where u_id='$uidphp' and Q_id='$Q_id';";
        $result=dbQuery($sql) or die('Cannot get questions. ' . mysql_error());
        if(mysql_num_rows($result)>0){
            $ret[1]="1";
            extract(mysql_fetch_assoc($result));
            $ret[2]=$wronged;$ret[3]=$hinted;$ret[4]=$completed;$ret[5]=$score;
        }
        else
            $ret[1]="0";
    }
}

if($action=='setquserdetails'){ // set question stats for user (known user)
    if($uidphp!='notknown'){
        $w= isset($_GET['w']) ? $_GET['w'] : '0';
        $h= isset($_GET['h']) ? $_GET['h'] : '0';
        $c= isset($_GET['c']) ? $_GET['c'] : '0';
        $s= isset($_GET['s']) ? $_GET['s'] : '0';
            //to find out if we have to insert or update
            $sql="select * from users_ques where u_id='$uidphp' and Q_id='$Q_id';";
            $result=dbQuery($sql) or die('Cannot get questions. ' . mysql_error());
            if(mysql_num_rows($result)>0){
                //then update
                $sql1="UPDATE users_ques SET `hinted`='$h',`wronged`='$w',`completed`='$c',`score`='$s' WHERE u_id='$uidphp' and Q_id='$Q_id'";
            }
            else{
                $sql1="INSERT INTO `users_ques`(`u_id`, `Q_id`, `hinted`, `wronged`, `completed`, `score`) VALUES ('$uidphp','$Q_id','$h','$w','$c','$s')";
            }
            $result1=dbQuery($sql1) or die('Cannot get questions. ' . mysql_error());
        $ret[0]="1"; //always
    }
}

echo json_encode($ret);
?>