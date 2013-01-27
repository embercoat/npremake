<?php
echo Form::open('/admin/user/editGroup/'.$groupId)
    .Form::hidden('groupid', $groupId)

    .Form::label('name', 'Namn')
    .Form::input('name', $group['name'])

    .Form::label('shortname', 'Kortnamn')
    .Form::input('shortname', $group['shortname'])

    .Form::label('union', 'Kårtillhörighet')
    .Form::select('union', $unions, $group['union'])

    .Form::submit('', 'Spara')
    .Form::close();
?>
<div style="float: left; clear: both;">
<h1>Members</h1>
<table>
<thead>
	<tr>
		<td style="width: 250px;">Name</td>
		<td style="width: 150px;">Role</td>
		<td style="width: 50px;">Year</td>
		<td style="width: 50px;">Modify</td>
	</tr>
</thead>
<tbody>
<?php
foreach($members as $m){
    ?>
    <tr>
    	<td><?php echo $m['fname'].' '.$m['lname'];?></td>
        <td><?php echo $m['membertype'];?></td>
        <td><?php echo $m['year']; ?></td>
        <td>
        	<a href="/admin/user/editUser/<?php echo $m['user_id']; ?>/"><img src="/images/icon/edit.gif" /></a>
        	<a href="/admin/user/removeFromGroup/<?php echo$m['user_id'].'/'.$groupId; ?>"><img src="/images/icon/red_x.svg" height="14px" /></a>
        </td>

    </tr>
    <?
}
?>
</tbody>
</table>
<br />
<h1>Hemklassrum</h1>
<a href="javascript:showHomeroom()">Lägg till Hemklassrum</a>
<table>
	<thead>
		<tr>
			<td style="width: 250px;">Name</td>
			<td style="width: 100px;">Year</td>
			<td style="width: 50px;">Modify</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($homeroom as $h){ ?>
		<tr>
			<td><?php echo $h['room']; ?></td>
			<td><?php echo $h['year']; ?></td>
			<td>
        		<a href="/admin/user/removeHomeroomGroup/<?php echo $groupId.'/'.$h['homeroom_id'].'/'.$h['year']; ?>">
        			<img src="/images/icon/red_x.svg" height="14px" />
        		</a>
        </td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
<div style="position: fixed; top: 200px; left: 600px; background: lightGreen; padding: 10px;" id="editBox" class="preHidden">
	<?php echo Form::open("/admin/data/editHomeroom/", array('id' => 'editForm'))
		.Form::hidden('groupId', $groupId, array('id' => 'oldname'))
		.Form::label('homeroom', 'Hemklassrum')
		.Form::select('homeroom')
		.Form::submit('save', 'Spara')
	    .Form::close()
	    .Form::button('abort','Avbryt', array('onclick' => 'hideEditBox()')); ?>
</div>
