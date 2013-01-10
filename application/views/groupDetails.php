<div style="float: left; clear: both;">
<h1>Grupp: <?=$group['name']; ?> </h1>
<h1>Medlemmar</h1>
<table>
<thead>
	<tr>
		<td style="width: 250px;">Namn</td>
		<td style="width: 150px;">Roll</td>
		<td style="width: 50px;">År</td>
	</tr>
</thead>
<tbody>
<?
$resp = array();
foreach($members as $m){
    $resp[$m['user_id']] = $m['fname'].' '.$m['lname'];
    ?>
    <tr <?php echo ($m['year'] != date('Y')) ? 'class="greyout"' : ''; ?>>
    	<td><?=$m['fname'].' '.$m['lname'];?></td>
        <td><?=$m['membertype'];?></td>
        <td><?=$m['year']; ?></td>
    </tr>
    <?
}
?>
</tbody>
</table>
<br />
<h1>Hemklassrum</h1>
<table>
	<thead>
		<tr>
			<td style="width: 250px;">Rum</td>
			<td style="width: 100px;">År</td>
		</tr>
	</thead>
	<tbody>
		<?php  foreach($homerooms as $h){ ?>
		<tr <?php echo ($m['year'] != date('Y')) ? 'class="greyout"' : ''; ?>>
			<td><?=$h['room']; ?></td>
			<td><?=$h['year']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<br />
<h1>Ansvar</h1>
<a href="#" onclick='editResponsibility()'>Lägg till Ansvarig</a>
<table>
	<thead>
		<tr>
			<td style="width: 250px;">Vem</td>
			<td style="width: 100px;">Telefon</td>
			<td style="width: 100px;">Start</td>
			<td style="width: 100px;">Slut</td>
			<td style="width: 100px;">Prioritet</td>
		</tr>
	</thead>
	<tbody>
		<?php  foreach($responsibilities as $r){ ?>
		<tr>
			<td><?=$r['fname'].' '. $r['lname']; ?></td>
			<td><?=$r['phone']; ?></td>
			<td><?=date('Y-m-d H:i', $r['start']); ?></td>
			<td><?=date('Y-m-d H:i', $r['end']); ?></td>
			<td><?=$r['priority']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
<div style="position: fixed; top: 200px; left: 300px; background: lightGreen; padding: 10px;" id="editBox" class="preHidden">
	<form action="/me/groupDetails/<?=$group['id']; ?>" method="post">
		<?= Form::hidden('group_id', $group['id']); ?>
		<?= Form::label('user', 'Phösare'); ?>
		<?= Form::select('user', $resp);?>
		<?= Form::label('priority', 'Prioritet'); ?>
		<?= Form::input('priority', '1');?>
		<?= View::factory('datetimepicker')->set('field', 'start');?>
		<?= View::factory('datetimepicker')->set('field', 'end');?>
		<?= Form::submit('save', 'Spara'); ?>
	</form>
	<?= Form::button('abort','Avbryt', array('onclick' => 'hideEditBox()')); ?>
</div>