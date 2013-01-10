function addOrgMember(id){
	$('#editBox').show();
	$('#username').focus();
}
$(document).bind('keydown', 'ctrl+a', addOrgMember);
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
