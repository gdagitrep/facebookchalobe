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
    //4
    
    if($uidphp!='notknown'){
        $sql="select * from users_ques where u_id='$uidphp' and Q_id='$Q_id';";
        $result=dbQuery($sql) or die('Cannot get questions. ' . mysql_error())    ;
        if(mysql_num_rows($result)>0){
            $ret[1]="1";
            extract(mysql_fetch_assoc($result));
            $ret[3]=$hinted;
            $ret[2]=$wronged;
            $ret[4]=$completed;
            $ret[5]=$score;
        }
        else
            $ret[1]="0";
                
    }else{ //i.e. user is not known
    
        //5 -> score (default as derived from questions table)
        $ret[5]= $marks;
    }
}
if($action=='geta'){
    $sql= "select answer from questions where Q_id='$Q_id';";
    $result1= dbQuery($sql) or die('Cannot get answer. ' . mysql_error())    ;
    extract(mysql_fetch_assoc($result1));
    if($sel!= -1 && $sel== $answer)
        $ret[0]=1;
    else
        $ret[0]=0;
}

echo json_encode($ret);
?>