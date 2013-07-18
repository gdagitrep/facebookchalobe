<div style="margin-top:10px;line-height:35px ; width: 74%;float: right;
     height:35px;background-color:rgb(245, 245, 245); align:center;"><p style="width:600px; color:rgb(31, 75, 116) ;  font-size:26px;align:center;  text-shadow:#f9f9f9 0px 0px 2px;">Topics in <?php echo $course_storage[$course]['name'];?></p></div>
<div class="coursecontent">
<ul style="
    list-style-type: none;
    -webkit-padding-start: 0px;
    -webkit-margin-before: 0; 
    -webkit-margin-after: 0; -webkit-margin-start: 0px; -webkit-margin-end: 0px;
">
<?php
foreach ($topic_storage as $row) {
    extract($row);
    ?>
<li class="picturization_block">
    
    <a href="<?php echo $row['url']; ?>">
        <div style="font-family: cursive; font-size: 18px"><?php echo  $row['name']; ?></div>
        
    </a>
</li>
<?php    
}
?>

</ul>
</div>