(function($){jQuery(document).ready(function(){
    
//leftNav
    $list_css={
	"color": "#201f1c","padding-left": "20px",
        "-webkit-box-shadow": "none","box-shadow": "none","-moz-box-shadow": "none"
    };
    $listhover_css={"padding-left": "24px","color": "#dd0034","text-decoration": "none",
        "-webkit-box-shadow": "0 3px 8px rgba(0, 0, 0, 0.25)","box-shadow": "0 3px 8px rgba(0, 0, 0, 0.25)",
        "-moz-box-shadow": "0 3px 8px rgba(0,0,0,0.25)"
    };
    
    $tab_css={
        "border":"1px solid transparent"
    };
    $tab_hover_css={
        "-moz-border-radius": "5px","-ms-border-radius": "5px",
        "-webkit-border-radius": "5px","border-radius": "5px"
    };
    
    jQuery(".popout_all").hide();
    jQuery(".popout_all-subuni").hide();
    jQuery(".popout_all-click").hide();

    var tablist=".Courses-tab ,.Universities-tab ,  .Sub-Univ-tab, .Manga-tab, .Kitchen-tab";
    jQuery(tablist).css($tab_css);
    jQuery(".Courses-tab").hover(function(){
        jQuery(".popout_all", this).show();
        jQuery(".denapada", this).css($listhover_css);
        jQuery(this).css($tab_hover_css);
        
    },function(){jQuery(".popout_all", this).hide();
        jQuery(".denapada", this).css($list_css);
        jQuery(this).css($tab_css);
    });
    jQuery(".Universities-tab").hover(function(){
        jQuery(".popout_all-subuni", this).show();
        jQuery(".denapada", this).css($listhover_css);
        jQuery(this).css($tab_hover_css);
        
    },function(){jQuery(".popout_all-subuni", this).hide();
        jQuery(".denapada", this).css($list_css);
        jQuery(this).css($tab_css);
    });
    jQuery(".Sub-Univ-tab").hover(function(){
        jQuery(".popout_all-click", this).show();
//        jQuery(".popout_all-click", this).css({"top": this.top});
        jQuery(".denapada", this).css($listhover_css);
        jQuery(this).css($tab_hover_css);
        
    },function(){jQuery(".popout_all-click", this).hide();
        jQuery(".denapada", this).css($list_css);
        jQuery(this).css($tab_css);
    });
    
//leftNav over
    
//progress
    jQuery("#progress_dropdown").hide();
    jQuery("#cart_button").click(function(e){
        e.stopPropagation();
        e.preventDefault();
        jQuery("#progress_dropdown").toggle();
    });
    
    jQuery('#lgoutbox').hide();
    var up=1;
    jQuery('body').click(function(event) {
    if(up===1)
        event.stopPropagation();
    
    if ( !jQuery(event.target).closest('#lgoutbox').length) {
        jQuery('#lgoutbox').slideUp();
        up=1;
    };
    
    });
    jQuery('.close').click(function(event2){
        if (!jQuery(event2.target).closest('#lgoutbox').length) {
        jQuery('#lgoutbox').slideToggle();
        up=(up+1)%2;
        event2.stopPropagation();
        }
    });
    jQuery(window).scroll(function() {
        $el = $('#topbarfancy');
        if ($(this).scrollTop() > 80 && $el.css('position') !== 'fixed'){ 
            $el.css({'position': 'fixed', 'top': '0px','margin-top':'0px'});
        }
        if ($(this).scrollTop() < 80 && $el.css('position') === 'fixed'){ 
            $el.css({'position': 'absolute','margin-top':'80px'});
        }
    });

    ///    tabbed interface
    jQuery("#tabs li:first").attr("id","current"); // Activate first tab
    
    jQuery('#tabs a').click(function(e) {
        e.preventDefault();
        if (jQuery(this).closest("li").attr("id") == "current"){ //detection for current tab
            return;
        }
        else{             
        jQuery("#tabs li").attr("id",""); //Reset id's
        jQuery(this).parent().attr("id","current"); // Activate this
        }
    });
    //tabbed interface ends
    
      //jQuery('#nav').localScroll({duration:800});
      jQuery('#tutt').localScroll({duration:800,lazy:true});
      
        
        


});
})(jQuery);
function ajaxcall(action,uid,qid,n, sel) // n for question no starting from 1
  {
    //-----------------------------------------------------------------------
    // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
    //-----------------------------------------------------------------------
    return jQuery.ajax({                                      
      url: 'include/questions.php?action='+action+'&uid='+uid+'&QID='+qid+'&N='+n+'&sel='+sel,                  //the script to call to get data          
      data: "",                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'json'               //data format      
//      success: function(data)          //on recieve of reply
//      {
//          return data;
//        
//        //ajaxqtype=data[2];
//        //--------------------------------------------------------------------
//        // 3) Update html content
//        //--------------------------------------------------------------------
//        //Set output element html
//        //recommend reading up on jquery selectors they are awesome 
//        // http://api.jquery.com/category/selectors/
//      } 
    });
  };
  
function getquestion(uidjs,qidjs,n,nq){ // n is the number (starting from 1) of question, 
                                    //while qid is the id of the question as per table
  var promise = ajaxcall('getq',uidjs,qidjs,n,-1);
  promise.success(function(data){
      jQuery("#questiontext").html(data[0]);
      var qsolved,w,h,c;
      score= data[5]; // *****
      if(uidjs != 'notknown'){
          if(data[1]=='1') {//i.e. there is entry for this question in database for this user
              qsolved= data[2];
              w=1;h=1;c=1;score=1; //change this line
          }
          else{
              qsolved= null;
          }
      }
      else{
          qsolved=checkCookie(qidjs);
          if(qsolved!=null && qsolved!=""){
              var vars = qsolved.split('&');
              w=vars[0];
              h=vars[1];
              c=vars[2];
              score=vars[3]; //overwrites the above stored value // *****
          }
      }
      
      
      if(qsolved!=null && qsolved!=""){
          if(h!=0){
                  //show hint;
            }
          if(w==0){
              if(c==1){
                  jQuery('#msg').html('<span style="color: green">Yieee!! You solved this question in first attempt</span>');
                  correctans(n,nq);
              }
              else{
                    refreshquestionnaire(n,nq);
              }
          }
          if(w==1){
              if(c==1){
                  jQuery('#msg').html('<span style="color: green">Hmmm!! You solved this question in second attempt</span>');
                  correctans(n,nq);
              }
              else{
                    refreshquestionnaire(n,nq);
              }
          }
          if(w==2){
                wronganswer(n,nq);
                jQuery('#msg').html('<span style="color: red">Alas! Two attempts exhausted. See solution</span>');
                jQuery('#buttonhint').text('Show Solution');
                //jQuery('#buttonhint').addClass('greenbutton');
                jQuery('#buttonsubmitcover').hide();
          }
          
          
          
//          if(qsolved==1)
//              correctans(n,nq);
//          else
//              wronganswer(n,nq);
      }
      else
          refreshquestionnaire(n,nq);
  });
};
function submitanswer(qidjs,uidjs,n,nq){
  var selected = jQuery( "input[type='radio'][name='corans']:checked");
  var ajaxcorans;
  var w,h,c,s;

  var promise = ajaxcall('geta',uidjs,qidjs,-1,selected.val());
  if(uidjs=='notknown'){
    var qsolved=checkCookie(qidjs);
    if(qsolved!=null && qsolved!=""){
          var vars = qsolved.split('&');
          w=vars[0];
          h=vars[1];
          c=vars[2];
          s=vars[3];
      }
      else{w=0; h=0; c=0; 
          s= score; // default score of the question from questions table
      }
      
    promise.success(function(data){
        ajaxcorans = data[0]; //whether selection was correct or not,   
                            //i.e. option number if correct otherwise 0
        if(ajaxcorans != 0){
            correctans(n,nq);
            setCookie('qid'+qidjs,w+'&'+h+'&'+'1&'+s,1); //w&h&c&s
        }
        else{
             wronganswer(n,nq);
             w=w+1;
             if(w<2){
                s= score = score/2;
                setCookie('qid'+qidjs,w+'&'+h+'&'+'0&'+s,1);
                //set Wronged text as new w
                //update scores visible above
             }
             else{
                 score=2;
                 setCookie('qid'+qidjs,'2&'+h+'&'+'1&0',1);
                //set Wronged text as 2
                //update scores visible above as 0
                jQuery('#buttonsubmitcover').hide();
             }
        }

            

    });
  }
    
  
};
function skip(qidjs,uidjs){
    if(uidjs=='notknown'){
        var w,h, c, s;
        var qsolved=checkCookie(qidjs);
        if(qsolved!=null && qsolved!=""){
          var vars = qsolved.split('&');
          w=vars[0];
          h=vars[1];
          c=vars[2];
          s=vars[3];
        }
        else{
            
            w=0; h=0; c=0; 
            s= score; // default score of the question from questions table
        }
        setCookie('qid'+qidjs,w+'&'+h+'&'+c+'&'+s,1);
    }
}

function changegr(){
    jQuery('#buttonsubmit').removeClass('button').addClass('greenbutton');
};
function scoreimg(){
    jQuery('#ido12').stop().animate({
        boxShadow: '0 1px 20px 5px'},'normal').animate({
        boxShadow:"0 1px 2px 1px"},'normal').animate({
        boxShadow: '0 1px 20px 5px'},'normal').animate({
        boxShadow:"0 1px 2px 1px"},'normal');
//        "-webkit-box-shadow":"0 1px 2px 1px rgba(0, 51, 255, 0.96)"});
};
function correctans(n,nq){ // set buttons in case answer is correct
    jQuery('#buttonhint').text('Show Solution');
    jQuery('#buttonhint').addClass('greenbutton');
    jQuery('#buttonnext').addClass('greenbutton');
    jQuery('#buttonnext').text('Correct! Next question');
    //jQuery('#msg').html('<span style="color: green">Success!!!</span>');
    jQuery('#buttonsubmitcover').hide();
    if(n<nq)
        jQuery('#buttonnextcover').show();
    else
        jQuery('#buttonnextcover').hide();
};
function wronganswer(n,nq){//set buttons in case answer is wrong
    jQuery('#buttonsubmitcover').show();
    jQuery('#buttonsubmit').removeClass('greenbutton').addClass('button');
//      jQuery('#buttonsubmit').text('Wrong!');
    jQuery('#msg').html('<span style="color: red">Wrong!! Get the hint, and try again</span>');
    if(n<nq)
    {
        jQuery('#buttonnextcover').show();
        jQuery('#buttonnext').removeClass('greenbutton');
        jQuery('#buttonnext').text('Skip to Next question');
    }
    else
        jQuery('#buttonnextcover').hide();
    jQuery('#buttonhint').text('Hint');
    jQuery('#buttonhint').removeClass('greenbutton');
};
function refreshquestionnaire(i,nq){
    jQuery('#buttonsubmit').removeClass('greenbutton').addClass('button');
    jQuery('#buttonsubmit').text('Submit');
     jQuery('#msg').html('');
    jQuery('#buttonsubmitcover').show();
    jQuery('#buttonhint').text("Show Hint");
    jQuery('#buttonhint').removeClass('greenbutton');
    if(i>=nq)
        jQuery('#buttonnextcover').hide();
    else{
        jQuery('#buttonnextcover').show();
        jQuery('#buttonnext').removeClass('greenbutton');
        jQuery('#buttonnext').text('Skip to Next question');
    }
};

function getCookie(c_name)
{
var c_value = document.cookie;
var c_start = c_value.indexOf(" " + c_name + "=");
if (c_start === -1)
  {
  c_start = c_value.indexOf(c_name + "=");
  }
if (c_start === -1)
  {
  c_value = null;
  }
else
  {
  c_start = c_value.indexOf("=", c_start) + 1;
  var c_end = c_value.indexOf(";", c_start);
  if (c_end === -1)
    {
    c_end = c_value.length;
    }
  c_value = unescape(c_value.substring(c_start,c_end));
  }
return c_value;
};

function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays===null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;
};

function checkCookie(qid)
{
var questionsolved=getCookie("qid"+qid); 
  return questionsolved;
};
    
 