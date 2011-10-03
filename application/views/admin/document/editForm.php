<?=Form::open('/admin/document/edit/'.$document_id, array('method' => 'post')); ?>
<p>
<?
echo Form::label('name', 'Namn')
    .Form::input('name', $document['name'])
    .Form::label('description', 'Beskrivning')
    .Form::textarea('description', $document['description'])
    .Form::label('requirePhosare', 'Måste vara phösare?')
    .Form::checkbox('requirePhosare', '1', (($document['requirePhosare'] == 1) ? true : false))
    .Form::label('requireLogin', 'Måste vara inloggad?')
    .Form::checkbox('requireLogin', '1', (($document['requireLogin'] == 1) ? true : false))
    .Form::label('requireAdmin', 'Måste vara Admin?')
    .Form::checkbox('requireAdmin', '1', (($document['requireAdmin'] == 1) ? true : false))
    .Form::submit('submit', 'Uppdatera');
?>
</p>
<?=Form::close(); ?>