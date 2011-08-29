<form action="/admin/user/group/edit/<?=$groupId?>" method="post">
<?=Form::hidden('groupid', $groupId);?>

<?=Form::label('name', 'Namn'); ?>
<?=Form::input('name', $group['name'])?>

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
</div>
