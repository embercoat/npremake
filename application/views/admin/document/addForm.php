<?=Form::open('/admin/document/upload', array('method' => 'post', 'enctype' => 'multipart/form-data')); ?>
<p>
<?
echo Form::label('name', 'Namn')
    .Form::input('name')
    .Form::label('description', 'Beskrivning')
    .Form::textarea('description')
    .Form::label('requirePhosare', 'Måste vara phösare?')
    .Form::checkbox('requirePhosare', '1')
    .Form::label('requireLogin', 'Måste vara inloggad?')
    .Form::checkbox('requireLogin', '1')
    .Form::label('requireAdmin', 'Måste vara Admin?')
    .Form::checkbox('requireAdmin', '1')
    .Form::file('file')
    .Form::submit('submit', 'Ladda Upp');
?>
</p>
<?=Form::close(); ?>