<div id="sidebar2" ><!-- class="mousescroll" -->
    <div class="sidebar_section">
<?php
//echo "ram ram";
$topic_storage=array();
$subtopic_storage=array();
$flag=0;
$sql = "select topics.topic_id as topic_d, topics.name as topicc from courses_topics inner join topics on courses_topics.topic_id = topics.topic_id where courses_topics.course_id=$course order by courses_topics.topic_id";
$result = dbQuery($sql);
while ($row = dbFetchAssoc($result)) {
    extract($row);
    $topic_storage[$topic_d]= array('name'  => $topicc,'topic_id'=> $topic_d,'url'=>'');
    $sql= "select name,subtopics.subt_id from topics_subtopics left join subtopics on 
    topics_subtopics.subt_id= subtopics.subt_id where topics_subtopics.topic_id= $topic_d";
    $result1=  dbQuery($sql);
    $row1=  dbFetchAssoc($result1);
    extract($row1);
    $surl="index.php?&c=".encrypt($course)."&su=".encrypt($subuniversity)."&st=".encrypt($subt_id);
    $topic_storage[$topic_d]['url']=$surl;
    $subtopic_storage[$subt_id]=array('name'=> $name, 'subt_id'=>$subt_id,'url'=>$surl,
        'next'=>'');

    if($flag!=0){$subtopic_storage[$subt_id]['next']=$flag;$flag=0;}
    if($subtopicid==$subt_id){$flag= $subt_id;}

    ?>
    <a class="topics lefttitle" title="<?php echo $topicc?>" <?php echo "href=\"$surl\""?>>
        <font size="1.5" face="verdana">
        <span class="oneline"><?php echo  $topicc; ?></span></font></a>
    <a class="subtopics lefttitle" title="<?php echo $name?>" <?php echo "href=\"$surl\""?>>
        <span class="oneline" <?php if($subtopicid==$subt_id){?>style="font-weight: bold"<? }?>>
        <font size="1.5" face="verdana" >
            <?php echo  $name; ?></font></span></a>
            <?php

while($row1=  dbFetchAssoc($result1)){
    extract($row1);
    $surl="index.php?&c=".encrypt($course)."&su=".encrypt($subuniversity)."&st=".encrypt($subt_id);
    $subtopic_storage[$subt_id]=array('name'=> $name, 'subt_id'=>$subt_id,'url'=>$surl,'next'=>'');

    if($flag!=0){$subtopic_storage[$flag]['next']=$subt_id;$flag=0;}
    if($subtopicid==$subt_id){$flag= $subt_id;}
    ?>
        
    <a class="subtopics lefttitle" title="<?php echo $name?>" <?php echo "href=\"$surl\""?>>
        <span class="oneline" <?php if($subtopicid==$subt_id){?>style="font-weight: bold"<? }?>>
        <font size="1.5" face="verdana" >
            <?php echo  $name; ?></font></span></a>
    <?php
    }
    
}
?>
    </div>
</div>
