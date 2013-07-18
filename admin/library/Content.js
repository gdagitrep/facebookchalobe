// JavaScript Document
function viewCourse()
{
	with (window.document.frmListCourse) {
		if (cboCategory.selectedIndex == 0) {
			window.location.href = 'index.php';
		} else {
			window.location.href = 'index.php?catId=' + cboCategory.options[cboCategory.selectedIndex].value;
		}
	}
}

function checkAddSubtopicForm()
{
	with (window.document.frmAddsubTopic) {
		if (jQuery('#checkArray :checkbox:checked').length <= 0) {
			alert('Choose the Topic');
			//Topicsforsubtopicmodify.focus();
			return;
//		} else 
//                if (isEmpty(txtName, 'Enter Subtopic name')) {
//			return;
		} else {
			submit();
		}
	}
}
function checkAddQuestionForm()
{
	with (window.document.frmAddquestion) {
            if (jQuery('#aftersubtopic').val()==0) {
                alert('Choose the SubTopic after which this question will appear');
			return;
		} else 
                if (tinyMCE.get('txtquestiontext').getContent()=="") {
                    alert('Write question text');
                    return;
		} else {
			var qt=jQuery('input[name=qtype]:radio:checked').val();
			if(qt=="0" || typeof qt ==="undefined"){
				alert('Select question type');return;}
			else{
				if(qt=="O"){
					var cs=jQuery('input[name=correctans]:radio:checked').val();
                    if(cs=="0" || typeof cs ==="undefined"){
                    	alert('Select the correct option');
                    	return;}
                    else{
                        if(tinyMCE.get('txt'+(jQuery('input[name=correctans]:radio:checked').val())+'option').getContent()=="")
                            alert('You forgot to mention the text in the correct options box');
                        else
                            submit();

                    }
                }
                else{ //if(qt=="S")
                	if(tinyMCE.get('correctansS').getContent()==""){
                		alert('Please mention the answer to this subjective question');
                		return;
                	}
                	else
                		submit();

            	}
			}
		}
	}
}

function addCourse()
{
	window.location.href = 'index.php?view=add';
}

function modifyCourse(CourseId)
{
	window.location.href = 'index.php?view=modify&CourseId=' + CourseId;
}

function deleteCourse(CourseId, catId)
{
	if (confirm('Delete this Course?')) {
		window.location.href = 'processCourse.php?action=deleteCourse&CourseId=' + CourseId + '&catId=' + catId;
	}
}

function deleteImage(CourseId)
{
	if (confirm('Delete this image')) {
		window.location.href = 'processCourse.php?action=deleteImage&CourseId=' + CourseId;
	}
}

function addsubTopic()
{
	window.location.href = 'index.php?view=add';
}