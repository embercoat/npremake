function addOrgMember(id){
	$('#edit').val(0);
	$('#username').val('').prop('disabled', false);
	$('#title').val('');
	$('#userid').val('');
	$('#is_admin').attr('checked', false)
	$('#editBox').show();
	$('#username').focus();
}
function hideEditBox(){
	$('#editBox').hide();
}
function editMember(userid, name, title, is_admin){
	$('#edit').val(1);
	$('#username').val(name).prop('disabled', true);
	$('#title').val(title);
	$('#userid').val(userid);
	if(is_admin == 1){
		$('#is_admin').attr('checked', true)
	} else {
		$('#is_admin').attr('checked', false)
	}
	$('#editBox').show();
}

$(document).bind('keydown', 'ctrl+a', addOrgMember);
$(document).bind('keydown', 'ctrl+f1', function(){
	$(document).bind('keydown', 'alt+n', function(){ window.location.href = '/admin/news/'; });
});


$(document).ready(function(){
	$("#username").autocomplete({
		source: function( request, response ) {
			rpc = new XmlRpc('/xmlrpc');
			r = rpc.call('rpc.autocomplete', 'name', request.term);
			response($.map( r, function( item ) {
				return {
					label: item['name'],
					value: item['name'],
					id: item['user_id']
				}
			}));
		},
		minLength: 2,
		select: function( event, ui ) {
			$('#userid').val(ui.item.id);
		},
		open: function() {
			$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
		},
		close: function() {
			$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
		},
		autoFocus: true
	});
});
