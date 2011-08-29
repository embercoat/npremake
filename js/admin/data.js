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