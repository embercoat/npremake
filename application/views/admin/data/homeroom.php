<a href="#" onclick="addHomeroom()">Add Homeroom</a>

<table>
	<thead>
		<tr>
			<td style="width: 200px;">Hemklassrum</td>
			<td style="width: 200px;">Actions</td>
		</tr>
	</thead>
	<tbody>
<?  foreach($homerooms as $h){  ?>
		<tr>
			<td id="homeroom_<?=$h['homeroom_id'] ?>"><?=$h['room'] ?></td>
			<td>
				<a href="/admin/data/delhomeroom/<?=$h['homeroom_id'].'/'; ?>">
					<img src="/images/icon/red_x.svg" height="14px" />
				</a>
				<a href="#" onclick="editHomeroom(<?=$h['homeroom_id']; ?>)">
					<img src="/images/icon/edit.gif" />
				</a>
			</td>
		</tr>
<? } ?>
	</tbody>
</table>
<div style="position: fixed; top: 200px; left: 600px; background: lightGreen; padding: 10px;" id="editBox" class="preHidden">
	<form action="/admin/data/editHomeroom/" method="post">
		<?= Form::hidden('homeroom_id', '', array('id' => 'homeroom_id')); ?>
		<?= Form::hidden('oldname', '', array('id' => 'oldname')); ?>
		<?= Form::label('newname', 'Namn'); ?>
		<?= Form::input('newname', '', array('id' => 'newname')); ?>
		<?= Form::submit('save', 'Spara'); ?>
	</form>
	<?= Form::button('abort','Avbryt', array('onclick' => 'hideEditBox()')); ?>
</div>