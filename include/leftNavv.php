<div id="sidebar2">
    <div class="sidebar_section">
<?php
//echo "ram ram";
$sql = "select topics.topic_id as topic_d, topics.name as topicc from courses_topics left join courses on courses.course_id =courses_topics.course_id left join topics on courses_topics.topic_id = topics.topic_id where courses_topics.course_id=$course order by courses_topics.topic_id";
$result0 = dbQuery($sql);
while ($row = dbFetchAssoc($result0)) {
    extract($row);
    $sql= "select name,subtopics.subt_id from topics_subtopics left join subtopics on 
    topics_subtopics.subt_id= subtopics.subt_id where topics_subtopics.topic_id= $topic_d";
    $result1=  dbQuery($sql)    ;
    $row1=  dbFetchAssoc($result1);
    extract($row1);
    $surl="index.php?&c=".$course."&su=".$subuniversity."&st=".$subt_id;
    
    ?>
    <a class="topics"  <?php echo "href=\"$surl\""?>><font size="1.5" face="verdana">
        <span class="oneline"><?php echo  $topicc; ?></span></font></a>
    <a class="subtopics" title="<?php echo $name?>" <?php echo "href=\"$surl\""?>><span class="oneline">
        <font size="1.5" face="verdana" >
            <?php echo  $name; ?></font></span></a>
            <?php

while($row1=  dbFetchAssoc($result1)){
    extract($row1);
    $surl="index.php?&c=".$course."&su=".$subuniversity."&st=".$subt_id;
    ?>
        
    <a class="subtopics" title="<?php echo $name?>" <?php echo "href=\"$surl\""?>><span class="oneline">
        <font size="1.5" face="verdana" >
            <?php echo  $name; ?></font></span></a>
    <?php
    }
    
}
?>
    </div>
</div>
