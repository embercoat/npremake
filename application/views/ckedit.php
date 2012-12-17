<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function(){
    CKEDITOR.replace( 'ckedit' );
}
</script>

<form action="<?=$action; ?>" method="post">
    <textarea class="ckeditor" id="ckedit" name="ckedit"><?=$data; ?></textarea>
    <input type="submit" value="Save">
</form>