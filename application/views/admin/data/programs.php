<a href="#" onclick="addProgram()">Add Program</a>

<table>
	<thead>
		<tr>
			<td>Program</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
<?  foreach($programs as $p){  ?>
		<tr>
			<td id="program_<?=$p['id'] ?>"><?=$p['name'] ?></td>
			<td>
				<a href="/admin/data/delProgram/<?=$p['id'].'/'; ?>">
					<img src="/images/icon/red_x.svg" height="14px" />
				</a>
				<a href="#" onclick="editProgram(<?=$p['id']; ?>)">
					<img src="/images/icon/edit.gif" />
				</a>
			</td>
		</tr>
<? } ?>
	</tbody>
</table>
<div style="position: fixed; top: 200px; left: 600px; background: lightGreen; padding: 10px;" id="editBox" class="preHidden">
	<form action="/admin/data/editProgram/" method="post">
		<?= Form::hidden('program_id', '', array('id' => 'program_id')); ?>
		<?= Form::hidden('oldname', '', array('id' => 'oldname')); ?>
		<?= Form::label('newname', 'Namn'); ?>
		<?= Form::input('newname', '', array('id' => 'newname')); ?>
		<?= Form::submit('save', 'Spara'); ?>
	</form>
	<?= Form::button('abort','Avbryt', array('onclick' => 'hideEditBox()')); ?>
</div>