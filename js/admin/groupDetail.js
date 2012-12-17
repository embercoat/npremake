function showHomeroom(){
	$.getJSON('/json/getHomeroom', function(data) {
		var options = '';
		$.each(data, function(index, homeroom) {
			options = options + ('<option value="' + homeroom['homeroom_id'] + '">' + homeroom['room'] + '</li>');
		});
		$('#homeroom').html(options);
		$('#editForm').attr('action', '/admin/user/addGroupHomeroom/');
		$('#editBox').removeClass('preHidden');
	});
}
function hideEditBox() {
	$('#editBox').addClass('preHidden');
}