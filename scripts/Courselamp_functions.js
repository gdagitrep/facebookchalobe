jQuery.fn.toggleinline = function () {
    if(this.css('display')=="none")
        return this.css('display', 'inline-block');
    else
        return this.css('display', 'none');
};


jQuery(document).ready(function(){
    $('body').append('<div id="anchorTitle" class="anchorTitle"></div>');
    $('.lefttitle').each(function() {
    var a = $(this);
    a.hover(
    function() {
        showAnchorTitle(a, a.data('title'));
    },
    function() {
        hideAnchorTitle();
    }
    )
    .data('title', a.attr('title'))
    .removeAttr('title');
    });
                
    var wrapperminH=jQuery(window).height()-42;
    jQuery('#wrapper').css('min-height',wrapperminH);
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

    var tablist=".Courses-tab ,.Universities-tab ,  .Sub-Univ-tab";
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
        jQuery("#progress_dropdown").toggleinline();
    });
    jQuery("#bla").click(function(e){
        e.stopPropagation();
        e.preventDefault();
        jQuery("#sidebar").toggle();
        jQuery("#chalopub2").toggle();
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
//    jQuery(window).scroll(function() {
//        $el = $('#topbarfancy');
//        if ($(this).scrollTop() > 80 && $el.css('position') !== 'fixed'){ 
//            $el.css({'position': 'fixed', 'top': '0px','margin-top':'0px'});
//        }
//        if ($(this).scrollTop() < 80 && $el.css('position') === 'fixed'){ 
//            $el.css({'position': 'absolute','margin-top':'80px'});
//        }
//    });

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


    

function ajaxcall(action,uid,qid,n, sel,whcs) // n for question no starting from 1
  {
    //-----------------------------------------------------------------------
    // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
    //-----------------------------------------------------------------------
    return jQuery.ajax({                                      
      url: 'include/questions.php?action='+action+'&uid='+uid+'&QID='+qid+'&N='+n+'&sel='+sel+whcs,                  //the script to call to get data          
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
  stg=1; //used to represent stages of Hint,Answer,Explanation
  var promise = ajaxcall('getq',uidjs,qidjs,n,-1,'&');
  promise.success(function(data){
      jQuery("#questiontext").html(data[0]);
      var qsolved,w,h,c;
      scoreqt= data[5]; // ***** score from question table
      if(uidjs != 'notknown'){
          if(data[1]=='1') {//i.e. there is entry for this question in database for this user
              qsolved= data[1];
              w=data[2];h=data[3];c=data[4];s=data[5]; 
          }
          else{
              qsolved= null; s=scoreqt;
          }
      }
      else{
          qsolved=checkCookie(qidjs);
          if(qsolved!=null && qsolved!=""){
              var vars = qsolved.split('&');
              w=vars[0];
              h=vars[1];
              c=vars[2];
              s=vars[3]; //doesnt overwrite the above stored value in scoreqt // *****
          }
          else
            s=scoreqt;
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
                wronganswer(n,nq);
                jQuery('#msg').html('<span style="color: red">You attempted it wrong Once!! Try again</span>');
                    //refreshquestionnaire(n,nq);
              }
          }
          if(w==2){
                wronganswer(n,nq);
                jQuery('#msg').html('<span style="color: red">Alas! Two attempts exhausted. See solution</span>');
                jQuery('#buttonhint').text('Show Solution');
                //jQuery('#buttonhint').addClass('greenbutton');
                jQuery('#buttonsubmitcover').hide();
          }
          
         scoreimg(s);
      }
      else{
          refreshquestionnaire(n,nq); scoreimg(scoreqt);
        }
  });
};
function submitanswer(qidjs,uidjs,n,nq){
  var selected = jQuery( "input[type='radio'][name='corans']:checked");
  var ajaxcorans;
  var w,h,c,s;

  var promise = ajaxcall('geta',uidjs,qidjs,-1,selected.val(),'&');
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
          s= scoreqt; // default scoreqt of the question from questions table
      }
  }
    promise.success(function(data){
        ajaxcorans = data[0]; //whether selection was correct or not,   
                            //i.e. option number if correct otherwise 0
        if(uidjs !='notknown'){
            //for known user
            if(data[1]=="1"){//i.e. there is entry for this question in database for this user
            //$ret : 
            //1 -> 0 for question record not in db, 1 for opposite
            //2 -> wronged(1) or not (0)
            //3 -> hinted (1) or not (0)
            //4 -> completed (1) or not (0)
            //5 -> scoreqt -- left after all kind of deductions for every wrong action/ hint action/ 
                            //or 0 if two wrong tries have been exhausted
            w=data[2]; h= data[3];c=data[4];s= data[5];
            }
            else
                {w=0; h=0; c=0; s=scoreqt;}
        }
        if(ajaxcorans != 0){
            correctans(n,nq);
            jQuery('#msg').html('<span style="color: green">Success!!!</span>');
            if(uidjs=='notknown')
                setCookie('qid'+qidjs,w+'&'+h+'&'+'1&'+s,1); //w&h&c&s
            else{
                var succ;
                var promise1 = ajaxcall('setquserdetails',uidjs,qidjs,-1,-1,'&w='+w+'&h='+h+'&c=1&s='+s);
                promise1.success(function(data1){
                    succ=data1[0]; //of no use for now
                });
            }
        }
        else{
             wronganswer(n,nq);
             w=w+1;
             if(w<2){
                s= s/2;
                scoreimg(s);
                if(uidjs=='notknown')
                    setCookie('qid'+qidjs,w+'&'+h+'&'+'0&'+s,1);
                    //set Wronged text as new w
                    
                else{
                    var succ;
                    var promise1 = ajaxcall('setquserdetails',uidjs,qidjs,-1,-1,'&w='+w+'&h='+h+'&c=0&s='+s);
                    promise1.success(function(data1){
                        succ=data1[0]; //of no use for now
                    });
                }
             }
             else{
                jQuery('#buttonsubmitcover').hide();
                 s=0;
                 scoreimg(s);
                if(uidjs=='notknown')
                    setCookie('qid'+qidjs,'2&'+h+'&'+'1&0',1);
                   //set Wronged text as 2
                   //update scores visible above as 0
                else{
                    var succ;
                    var promise1 = ajaxcall('setquserdetails',uidjs,qidjs,-1,-1,'&w=2&h='+h+'&c=1&s=0');
                    promise1.success(function(data1){
                        succ=data1[0]; //of no use for now
                    });
                }
            }
        }
    });
};
function showhint(qidjs,uidjs){
  stg='2';
  if(scoreqt!="0") // means its not subjective
  {
    if(uidjs=='notknown'){
      var qsolved=checkCookie(qidjs);
      if(qsolved!=null && qsolved!=""){
            var vars = qsolved.split('&');
            w=vars[0];
            h=vars[1];
            c=vars[2];
            s=vars[3];
      }
      else{w=0; c=0; h=0;
            s= scoreqt; // default scoreqt of the question from questions table
        }
    }
    if(h!=1){
      s= s-2;
      scoreimg(s);
      h=1;
      if(uidjs=='notknown'){
        setCookie('qid'+qidjs,w+'&'+h+'&'+'0&'+s,1);
      }
    }
    var promise = ajaxcall('geth',uidjs,qidjs,-1,-1,'&w='+w+'&h='+h+'&c=0&s='+s);
    }
    else
      var promise = ajaxcall('geth',uidjs,qidjs,-1,-1,'&');//no need to set anything for SQs
    
    
    promise.success(function(data){
        var hinttext= data[6];
        if(scoreqt==0){ //for SQ, get answer and expl in one go, however, they will be displayed later. But not for OQs
          anstext=data[8];
          expltext=data[7];
        }
        if(hinttext!=null && hinttext !=""){
          jQuery('#hinttext').html(hinttext);
        }else{
          jQuery('#hinttext').html("No hint yet available; ur scores are intact");

          //revert back changes to questionuser
          if(uidjs=='notknown'){
            s=s+2;
            setCookie('qid'+qidjs,w+'&'+h+'&'+'0&'+s,1);
          }else{
            var promise1 = ajaxcall('setquserdetails',uidjs,qidjs,-1,-1,'&w='+w+'&h='+h+'&c=0&s='+s);
                promise1.success(function(data1){
                    succ=data1[0]; //of no use for now
                });
          }

        }
        jQuery('#buttonhint').text('Show Answer');
    });
  
}

function showans(qidjs,uidjs){
  stg='3';
  scoreimg(0);
  if(scoreqt==0){ //ie. subjective question
    jQuery('#anstext').html(anstext);
    jQuery('#solntext').html(expltext);
    jQuery('#buttonhintcover').hide();
  }
  else
    var promise = ajaxcall('getexpl',uidjs,qidjs,-1,-1,'&h=1&c=1&s=0');

    promise.success(function(data){
        anstext=data[8];
        expltext=data[7];        
        jQuery('#anstext').html(anstext);
        jQuery('#solntext').html(expltext);
        jQuery('#buttonhintcover').hide();
    });
    if(uidjs=='notknown'){ //check it again, not complete -----------
        var w;
        var qsolved=checkCookie(qidjs);
        if(qsolved!=null && qsolved!=""){
          var vars = qsolved.split('&');
          w=vars[0];
        }
        else{
            w=0;
        }
        setCookie('qid'+qidjs,w+'&1&1&0',1); //we are assuming hint as 1 for ans to see
    }
  
}
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
            s= scoreqt; // default scoreqt of the question from questions table
        }
        setCookie('qid'+qidjs,w+'&'+h+'&'+c+'&'+s,1);
    }
}

function changegr(){ // rather show submit button 
    //jQuery('#buttonsubmit').removeClass('button').addClass('greenbutton');
    jQuery('#buttonsubmitcover').show();
};
function scoreimg(scorefloat){
  if(scoreqt!='0'){
    jQuery('#ido12').html(scorefloat+'/'+scoreqt);
    jQuery('#ido12').stop().animate({
        boxShadow: '0 1px 20px 5px'},'normal').animate({
        boxShadow:"0 1px 2px 1px"},'normal').animate({
        boxShadow: '0 1px 20px 5px'},'normal').animate({
        boxShadow:"0 1px 2px 1px"},'normal');
  }
  else{
    jQuery('#ido12').html('NA');
  }
//        "-webkit-box-shadow":"0 1px 2px 1px rgba(0, 51, 255, 0.96)"});
};
function correctans(n,nq){ // set buttons in case answer is correct
    jQuery('#buttonhint').text('Show Solution');
    jQuery('#buttonhint').addClass('greenbutton');
    jQuery('#buttonnext').addClass('greenbutton');
    jQuery('#buttonnext').text('Correct! Next question');
    
    jQuery('#buttonsubmitcover').hide();
    if(n<nq)
        jQuery('#buttonnextcover').show();
    else
        jQuery('#buttonnextcover').hide();
};
function wronganswer(n,nq){//set buttons in case answer is wrong
    jQuery('#buttonsubmitcover').hide();
    jQuery('#buttonsubmit').removeClass('greenbutton').addClass('button');
    jQuery('#msg').html('<span style="color: red">Wrong!! Get hint, and try again</span>');
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
    //jQuery('#buttonsubmit').text('Submit');
    jQuery('#msg').html('');
    jQuery('#buttonsubmitcover').hide();
    jQuery('#buttonhint').text("Show Hint");
    jQuery('#hinttext').html("");
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
    
 function showAnchorTitle(element, text) {

                var offset = element.offset();

                $('#anchorTitle')
                .css({
                    'top'  : (offset.top /*+ element.outerHeight() + 4*/) + 'px',
                    'left' : offset.left + 'px'
                })
                .html(text)
                .show();

}

function hideAnchorTitle() {
    $('#anchorTitle').hide();
}
