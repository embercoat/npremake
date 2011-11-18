<form action="/admin/user/editGroup/<?=$groupId; ?>" method="post">
<?=Form::hidden('groupid', $groupId);?>

<?=Form::label('name', 'Namn'); ?>
<?=Form::input('name', $group['name'])?>

<?=Form::label('shortname', 'Kortnamn'); ?>
<?=Form::input('shortname', $group['shortname'])?>

<?=Form::submit('', 'Spara');?>
</form>
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
<?
foreach($members as $m){
    ?>
    <tr>
    	<td><?=$m['fname'].' '.$m['lname'];?></td>
        <td><?=$m['membertype'];?></td>
        <td><?=$m['year']; ?></td>
        <td>
        	<a href="/admin/user/editUser/<?=$m['user_id']; ?>/"><img src="/images/icon/edit.gif" /></a>
        	<a href="/admin/user/removeFromGroup/<?=$m['user_id'].'/'.$groupId; ?>"><img src="/images/icon/red_x.svg" height="14px" /></a>
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
		<?php  foreach($homeroom as $h){ ?>
		<tr>
			<td><?=$h['room']; ?></td>
			<td><?=$h['year']; ?></td>
			<td>
        		<a href="/admin/user/removeHomeroomGroup/<?=$groupId.'/'.$h['homeroom_id'].'/'.$h['year']; ?>">
        			<img src="/images/icon/red_x.svg" height="14px" />
        		</a>
        </td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
<div style="position: fixed; top: 200px; left: 600px; background: lightGreen; padding: 10px;" id="editBox" class="preHidden">
	<form action="/admin/data/editHomeroom/" method="post" id="editForm">
		<?= Form::hidden('groupId', $groupId, array('id' => 'oldname')); ?>
		<?= Form::label('homeroom', 'Hemklassrum'); ?>
		<?= Form::select('homeroom'); ?>
		<?= Form::submit('save', 'Spara'); ?>
	</form>
	<?= Form::button('abort','Avbryt', array('onclick' => 'hideEditBox()')); ?>
</div>
