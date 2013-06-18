<?php
$sql1="select name as coursename from courses where course_id=$course";
$result0=  dbQuery($sql1);
extract(dbFetchAssoc($result0));
?>
<div style="margin-top:10px;line-height:35px ; width: 74%;float: right;
     height:35px;background-color:rgb(245, 245, 245); align:center;"><p style="width:600px; color:rgb(31, 75, 116) ;  font-size:26px;align:center;  text-shadow:#f9f9f9 0px 0px 2px;">Topics in <?php echo $coursename;?></p></div>
<div class="coursecontent">
<ul style="
    list-style-type: none;
    -webkit-padding-start: 0px;
    -webkit-margin-before: 0; 
    -webkit-margin-after: 0; -webkit-margin-start: 0px; -webkit-margin-end: 0px;
">
<?php
$sql = "select topics.topic_id as topic_d, topics.name as topicc from courses_topics left join courses on courses.course_id =courses_topics.course_id left join topics on courses_topics.topic_id = topics.topic_id where courses_topics.course_id=$course order by courses_topics.topic_id";
$result0 = dbQuery($sql);
while ($row = dbFetchAssoc($result0)) {
    extract($row);
    ?>
<li class="picturization_block">
    
    <a href="<?php echo '../logout.php'; ?>">
        <div style="font-family: cursive; font-size: 18px"><?php echo  $topicc; ?></div>
        
    </a>
    <?php
//$sql= "select name,subtopics.subt_id from topics_subtopics left join subtopics on 
//    topics_subtopics.subt_id= subtopics.subt_id where topics_subtopics.topic_id= $topic_d";
//$result1=  dbQuery($sql)    ;
//while($row1=  dbFetchAssoc($result1)){
//    extract($row1);
//    $surl="index.php?&c=".$course."&su=".$subuniversity."&st=".$subt_id;
    ?>
        
<!--    <a class="subtopics" title="<?php echo $name?>" <?php echo "href=\"$surl\""?>><span class="oneline">
        <font size="1.5" face="verdana" >
            <?php // echo  $name; ?>
        </font></span></a>-->
</li>
    <?php
//    }
    
}
?>

</ul>
</div>