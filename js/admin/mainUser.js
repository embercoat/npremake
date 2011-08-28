function performAction(){
	switch(document.getElementById('actionSelector').value){
		case 'addToGroup':{
			$.getJSON('/json/getGroups', function(data) {
				  var options = '';
				  $.each(data, function(id, group) {
					  options = options + ('<option value="' + group['id'] + '">' + group['name'] + '</li>');
				  });
				  $('#groupSelect').html(options);
				});
			$.getJSON('/json/getRole', function(data) {
				  var options = '';
				  $.each(data, function(id, type) {
					  options = options + ('<option value="' + type['id'] + '">' + type['name'] + '</li>');
				  });
				  $('#membershiptypeSelect').html(options);
				});
			$('#userForm').attr('action', '/admin/user/addToGroup/');
			$('#groupSelectForm').removeClass('preHidden');

			break;
		}
	}
}