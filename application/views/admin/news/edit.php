<div style="float: left;">
<?
echo  Form::open('/admin/news/edit/'.(isset($details) ? $details['id'] : ''), array('method' => 'post'))
	 .Form::label('title', 'Titel')
	 .Form::input('title', (isset($details) ? $details['title'] : ''))
	 .'<div style="float: left; clear: both;">'.Form::textarea('text', (isset($details) ? $details['text'] : '')).'</div>'
	 .Form::submit('submit', 'Spara');
?>
	<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript"> window.onload = function(){
		CKEDITOR.replace( 'text' );
		CKEDITOR.config.height = '600';
	};
	</script>
</div>