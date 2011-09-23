<?php
echo Form::open('/admin/data/updateOrganisation/'.$data['id'], array('method' => 'post'));
echo Form::hidden('organisationid', $data['id']);
echo Form::label('name', 'Namn');
echo Form::input('name', $data['name']);
echo Form::label('description', 'Beskrivning');
echo Form::textarea('description', $data['description']);
echo Form::label('type', 'Organisationstyp');
echo Form::select('type', $organisation_types, $data['id']);
echo Form::submit('', 'Uppdatera');

?>
<div style="float: left; clear: both;">
<table>
	<thead>
		<tr>
			<th style="width:200px;">Namn</th>
			<th style="width:200px;">Roll</th>
			<th style="width:150px;">Org Admin?</th>
			<th style="width:150px;">Modify</th>
		</tr>
	</thead>
	<tbody>
	<? foreach($members as $m) { ?> 
		<tr>
			<td><?=$m['fname'].' '.$m['lname']; ?></td>
			<td><?=$m['title']; ?></td>
			<td><?=(($m['isAdmin']==1)?'Yes':'No'); ?></td>
			<td>mod</td>
		</tr>
	<? } ?>
	</tbody>

</table>
</div>