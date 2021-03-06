<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$self = WEB_ROOT . 'admin/index.php';
?>
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="<?php echo WEB_ROOT;?>admin/include/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="<?php echo WEB_ROOT;?>../scripts/common.js"></script>
<script type="text/javascript" src="../../scripts/jquery-1.10.0.min.js"></script>
<?php
$n = count($script);
for ($i = 0; $i < $n; $i++) {
	if ($script[$i] != '') {
		echo '<script language="JavaScript" type="text/javascript" src="' . WEB_ROOT. 'admin/library/' . $script[$i]. '"></script>';
	}
}
?>
<script>
function ajaxcall2()
{return jQuery.ajax({                           
      url: '/admin/include/ajaxqueries.php',data: "",dataType: 'json' 
    });
  };
  function gethelp(){
    jQuery('#hiddenhelp').show();
    var promise2 = ajaxcall2();promise2.success(function(data){
      jQuery("#helptext").html(data[0]);});
  }
</script>

<script type="text/javascript" src="<?php echo WEB_ROOT;?>admin/library/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo WEB_ROOT;?>admin/library/js/tinymce/jscripts/tiny_mce/plugins/asciimath/js/ASCIIMathMLwFallback.js"></script>
<script type="text/javascript" src="<?php echo WEB_ROOT;?>admin/library/js/tinymce/jscripts/tiny_mce/plugins/asciisvg/js/ASCIIsvg.js"></script>
<script type="text/javascript">
 var AScgiloc = 'http://www.imathas.com/imathas/filter/graph/svgimg.php';
 var AMTcgiloc = "http://www.imathas.com/cgi-bin/mimetex.cgi";
</script>
<script type="text/javascript" src="/admin/library/latexit.js"></script>
<script type="text/javascript">LatexIT.add('p',true);</script>
<script type="text/javascript">
var AMTcgiloc = "http://www.imathas.com/cgi-bin/mimetex.cgi";  		//change me
tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        language : "en",
        plugins : "tiny_mce_wiris,jbimages,asciimath,asciisvg,autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
        //

        // Theme options
        //
        theme_advanced_buttons1 : "fullscreen,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "tiny_mce_wiris_formulaEditor,asciimath,asciimathcharmap,asciisvg,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "jbimages,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,hr,removeformat,visualaid,|, tablecontrols",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        //content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "admin/library/js/tinymce/examples/list/template_list.js",
        external_link_list_url : "admin/library/js/tinymce/examples/list/link_list.js",
        external_image_list_url : "admin/library/js/tinymce/examples/list/image_list.js",
        media_external_list_url : "admin/library/js/tinymce/examples/list/media_list.js",
        
        AScgiloc : '<?php echo WEB_ROOT;?>admin/library/js/tinymce/php/svgimg.php',			      //change me  
    ASdloc : '<?php echo WEB_ROOT;?>admin/library/js/tinymce/jscripts/tiny_mce/plugins/asciisvg/js/d.svg',  //change me  

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        },
        relative_urls : false

});
</script>

</head>
<body>
<div id="hiddenhelp" onclick="jQuery('#hiddenhelp').hide();"><div id="helptext"></div></div><div>
<table width="auto" border="0" align="center" cellpadding="0" cellspacing="1" class="graybox">
  <tr>
    <td width="150" valign="top" class="navArea"><p>&nbsp;</p>
    <a href="<?php echo WEB_ROOT; ?>" class="leftnav">User Site</a> 
    <a href="<?php echo WEB_ROOT; ?>admin/" class="leftnav">Home</a> 
	  <a href="<?php echo WEB_ROOT; ?>admin/universities/" class="leftnav">Universities</a>
	  <a href="<?php echo WEB_ROOT; ?>admin/courses/" class="leftnav">Courses</a> 
	  <a href="<?php echo WEB_ROOT; ?>admin/topics" class="leftnav">Topics</a> 
    <a href="<?php echo WEB_ROOT; ?>admin/subtopics" class="leftnav">SubTopics/Content</a> 
    <a href="<?php echo WEB_ROOT; ?>admin/topics" class="leftnav" title="To add/modify questions, select topic">Questions</a> 
    <a onclick="gethelp()" style="background-color: #81F078;cursor: pointer;height: 52px; " class="leftnav">Help in Equation writing</a>       
	  <a href="<?php echo WEB_ROOT; ?>admin/config/" class="leftnav">CourseLamp Config</a> 
	  <a href="<?php echo WEB_ROOT; ?>admin/user/" class="leftnav">User</a> 
	  <a href="<?php echo $self; ?>?logout" class="leftnav">Logout</a>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="100%" valign="top" class="contentArea"><table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr>
          <td>
<?php
require_once $content;	 
?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center">Copyright &copy;<!-- 2013 - --> <?php echo date('Y'); ?> <a href="http://www.CourseLamp.com"> CourseLamp- Learn under a lamp</a></p>
</body>
</html>
