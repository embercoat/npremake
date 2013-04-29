<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function(){
    CKEDITOR.replace( 'ckedit');
}
</script>
<?php
echo Form::open('/admin/sms/send')
    .Form::label('body', 'Text')
    .Form::textarea('body'); ?>




<?php echo View::factory('recipient_selector'); ?>



<?php echo Form::submit('', 'Skicka').Form::close(); ?>
