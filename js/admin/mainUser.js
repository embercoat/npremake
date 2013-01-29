function performAction(){
	$('.detailSelectForm').addClass('preHidden');
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
		case 'addToMission':{
			$.getJSON('/json/getMission', function(data) {
				  var options = '';
				  $.each(data, function(id, group) {
					  options = options + ('<option value="' + group['id'] + '">' + group['name'] + '</li>');
				  });
				  $('#missionSelect').html(options);
				});
			$('#userForm').attr('action', '/admin/user/addToMission/');
			$('#missionSelectForm').removeClass('preHidden');
		break;
		}
		case 'addToOrganisation':{
			$.getJSON('/json/getOrganisation', function(data) {
				  var options = '';
				  $.each(data, function(id, group) {
					  options = options + ('<option value="' + group['id'] + '">' + group['name'] + '</li>');
				  });
				  $('#orgSelect').html(options);
				});
			$('#userForm').attr('action', '/admin/user/addToOrganisation/');
			html = '';
			$(':checked').each(function(index, object){
				html = html+'<tr><td>'
						+$('#fname_' + object.value).html()
						+ ' '
						+$('#lname_' +object.value).html()
						+'</td><td><input type="text" name="role['+object.value+']" /></td>'
						+'<td><input type="checkbox" name="makeAdmin['+object.value+']" value="1"/></td></tr>\r\n';
			});
			$('#organisationList').html(html);
			$('#organisationSelectForm').removeClass('preHidden');

		break;
		}
	}
}
