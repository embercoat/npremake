function editProgram(id){
	$('#editBox').show();
	document.getElementById('newname').value = $('#program_'+id).html();
	document.getElementById('oldname').value = $('#program_'+id).html();
	document.getElementById('program_id').value = id; 
}
function addProgram(){
	$('#editBox').show();
	document.getElementById('program_id').value = 'new'; 
}
function addHomeroom(){
	document.getElementById('homeroom_id').value = 'new';
	$('#editBox').show();
	document.getElementById('newname').focus();
}
function editHomeroom(id){
	$('#editBox').show();
	document.getElementById('newname').value = $('#homeroom_'+id).html();
	document.getElementById('oldname').value = $('#homeroom_'+id).html();
	document.getElementById('homeroom_id').value = id; 
}


function hideEditBox(){
	$('#editBox').hide();
}