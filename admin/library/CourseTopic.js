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

function checkAddCourseForm()
{
	with (window.document.frmAddCourse) {
		if (univ_namesforcourse.selectedIndex == 0) {
			alert('Choose the Course category');
			cboCategory.focus();
			return;
		} else if (isEmpty(txtName, 'Enter Course name')) {
			return;
		} else {
			submit();
		}
	}
}
function checkAddTopicForm()
{
	with (window.document.frmAddTopic) {
		if (jQuery('#checkArray :checkbox:checked').length <= 0) {
			alert('Choose the Course');
			return;
		} else {
                    if(jQuery('#txtName').val()==""){
                        alert('Write Topic name in box');
                        return;
                    }
			submit();
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

function addTopic()
{
	window.location.href = 'index.php?view=add';
}