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
    .Form::textarea('body', '', array('class' => 'ckeditor')); ?>



  <script>
  $(document).ready(function() {
    $( "#tabs" ).tabs();
  });
  </script>
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Phösargrupper</a></li>
    <li><a href="#tabs-2">Phösartyper</a></li>
    <li><a href="#tabs-3">Phösare</a></li>
  </ul>
  <div id="tabs-1">
    <ul style="list-style: none;">
    <?php foreach($groups as $g){ ?>
    <li style="height:25px;"><input type="checkbox" name="group[]" value="<?php echo $g['id']; ?>" /><?php echo $g['name']; ?></li>
    <?php } ?></ul>
  </div>
  <div id="tabs-2">
    <ul style="list-style: none;">
    <?php foreach($membertypes as $m){ ?>
      <li style="height:25px;"><input type="checkbox" name="membertype[]" value="<?php echo $m['id']; ?>" /><?php echo $m['name']; ?></li>
    <?php } ?>
    </ul>
  </div>
  <div id="tabs-3">
    <ul style="list-style: none;">
    <?php foreach($phosare as $p){ ?>
      <li style="height:25px;"><input type="checkbox" name="phosare[]" value="<?php echo $p['user_id']; ?>" /><?php echo $p['fname'].' '.$p['lname']; ?></li>
    <?php } ?>
    </ul>
  </div>
</div>




<?php echo Form::submit('', 'Skicka').Form::close(); ?>
