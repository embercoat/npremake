<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function(){
    CKEDITOR.replace( 'ckedit');
}
</script>
<?php
echo Form::open('/admin/mail/send')
    .Form::label('subject', 'Titel')
    .Form::input('subject')
    .Form::textarea('body', '', array('class' => 'ckeditor'));

echo View::factory('recipient_selector');
echo Form::submit('', 'Skicka').Form::close();

?>
