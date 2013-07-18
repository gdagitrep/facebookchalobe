<?php
$sql= "select content from subtopics where subt_id='$subtopicid';";
$result=  dbQuery($sql) or die('Cannot get Subtopic. ' . mysql_error())    ;
extract(dbFetchAssoc($result));
$sql1= "select Q_id as quinto from questions where subt_id='$subtopicid';";
$result1=  dbQuery($sql1) or die('Cannot get questions. ' . mysql_error())    ;
?>
<div class="coursecontent">
<div class="contentpadding">
    <div class="contentheading"><?php echo $subtopic_storage[$subtopicid]['name'];?> </div>
    <br/>
    <div class="content" style="margin-bottom: 40px">
        <?php echo $content; ?>
    </div>
        <?php $nq=mysql_num_rows($result1);
        if($nq >0){  ?>
    <script>
        var qlist= new Array();  
        <?php while($row= dbFetchAssoc($result1)){
        extract($row);?>
        qlist.push(<?php echo $quinto?>);
        <?php } ?>
        var currenti=0;
        var coransgiven=0;
    </script>
    <div id="tutt"><a id="showq" href="#tutt" style="font-weight: bold; text-decoration: none"
       onclick="jQuery('#questionsbox').show();
                jQuery('#showq').hide();
                getquestion('<?php echo $uidphp?>',qlist[0],1,<?php echo $nq?>);">
        Show questions</a></div>
    <div id="questionsbox" style="display: none; position: relative">
        <div class='questionsboxScore'><img style="width: 50px" src="../images/adb_3.png"/>
            <div id="ido12">10 </div>
        </div>
        <div>
        <h4><a name="qbox">Questions</a></h4>
        <ul id="tabs">
            <?php $iq=1;
            while($iq<=$nq) {?>
            <li><a href="#" 
            onclick="getquestion('<?php echo $uidphp?>',qlist[<?php echo $iq-1?>],<?php echo $iq?>,<?php echo $nq?> ); 
                currenti=<?php echo $iq-1?>;" 
                   name="tab1"><?php echo "Q.".$iq ; ?></a></li>
            <?php $iq=$iq+1;} ?> 
        </ul>
        </div>
        <div id="questiontext" style="box-shadow: 0 -2px 3px -2px rgba(0, 0, 0, .5); padding-top: 20px">
        <br/>
        </div>
        <div style="float: right; width: 100%;">
            <table style="float: right">
                <tr>
                    <td style="width: 50px">
                        <div id="buttonsubmitcover" 
                            onclick="submitanswer(qlist[currenti],'<?php echo $uidphp?>', currenti,<?php echo $nq?> );">
                <a id="buttonsubmit" class="button"  >Submit</a>
                    </div>
                </td>
            
                <td>
                    <div id="buttonhintcover">
                        <a id="buttonhint" class="redbutton" style="width: 93px" 
                           onclick="if(stg==1){showhint(qlist[currenti],'<?php echo $uidphp?>');} else if(stg==2){showans(qlist[currenti],'<?php echo $uidphp?>');} " >Show Hint</a>
                   </div>
                </td>
                <td style="width:192px">
                    <div id="buttonnextcover"  
                        onclick="skip(qlist[currenti],'<?php echo $uidphp?>'); getquestion('<?php echo $uidphp?>',qlist[++currenti],1+currenti,<?php echo $nq?> );
                    jQuery('#tabs li').attr('id','');
                    jQuery('#tabs li:eq('+currenti+')').attr('id','current');">
                <a id="buttonnext" class="redbutton" style="width: 152px" >Skip to Next question</a> </div>
                </td>
                </tr>
                <tr>
                    <td colspan="3">
                    <div id="msg"></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                    <div id="wrnghnt" style="float: right"></div>
                    </td>
                </tr>
            
            </table>
    </div>
        <div id="hinttext"></div>
        <div id="anstext"></div>
        <div id="solntext"></div>
        
    </div>
    <?php        
    } ?>
<div class="buttons" style="float:right"><a href= "<?php echo $subtopic_storage[$subtopic_storage[$subtopicid]['next']]['url'];?>" class="button">Next</a></div>    
</div>

