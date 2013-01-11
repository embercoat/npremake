<?php
echo Form::open('/admin/data/updateOrganisation/'.$data['id'], array('method' => 'post'))
    .Form::hidden('organisationid', (($data)?$data['id']:'new'))
    .Form::label('name', 'Namn')
    .Form::input('name', $data['name'])
    .Form::label('description', 'Beskrivning')
    .Form::textarea('description', $data['description'])
    .Form::label('type', 'Organisationstyp')
    .Form::select('type', $organisation_types, $data['type'])
    .Form::submit('', 'Uppdatera')
    .Form::close();
?>
<div style="float: left; clear: both;">
<a href="#" onclick="addOrgMember()">Lägg till medlem</a>
<?php if($members){ ?>
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
	<?php foreach($members as $m) { ?>
		<tr>
			<td><?=$m['fname'].' '.$m['lname']; ?></td>
			<td><?=$m['title']; ?></td>
			<td><?=(($m['isAdmin']==1)?'Yes':'No'); ?></td>
			<td>
    			<a href="/admin/data/removeuserfromorganisation/<?php echo $data['id'].'/'.$m['user_id']; ?>"><img src="/images/icon/red_x.svg" height="14px" /></a>
    			<a href="javascript:editMember('<?php echo $m['user_id']; ?>', '<?php echo $m['fname'].' '.$m['lname']; ?>', '<?php echo $m['title']; ?>', <?php echo $m['isAdmin']; ?>)"><img src="/images/icon/edit.gif" /></a>
			</td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php } ?>
</div>
<div class="ui-widget" style="margin-top: 2em; font-family: Arial;"></div>
<div style="position: fixed; top: 200px; left: 600px; background: lightGreen; padding: 10px;" id="editBox" class="preHidden">
<?php echo Form::open("/admin/data/addusertoorganisation/")
	.Form::hidden('organisationid', (($data)?$data['id']:''))
	.Form::hidden('userid')
	.Form::hidden('edit', '0')
	.Form::label('user', 'Namn')
	.Form::input('username', '', array('id' => 'username'))
	.Form::label('title', 'Titel')
	.Form::input('title', '', array('id' => 'username'))
	.Form::label('is_admin', 'Admin?')
	.Form::checkbox('is_admin', '', array('id' => 'username'))
	.Form::submit('save', 'Spara')
    .Form::close()
    .Form::button('abort','Avbryt', array('onclick' => 'hideEditBox()'));
?>
</div>
