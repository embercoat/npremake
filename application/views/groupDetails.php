<div style="float: left; clear: both;">
<h1>Grupp: <?php echo $group['name']; ?> </h1>
<h1>Medlemmar</h1>
<table>
<thead>
	<tr>
		<th style="width: 250px;">Namn</td>
		<th style="width: 100px;">Roll</td>
		<th style="width: 50px;">År</td>
		<th style="width: 150px;">Epost</td>
		<th style="width: 150px;">Telefon</td>
	</tr>
</thead>
<tbody>
<?php
$resp = array();
foreach($members as $m){
    $resp[$m['user_id']] = $m['fname'].' '.$m['lname'];
    ?>
    <tr <?php echo ($m['year'] != date('Y')) ? 'class="greyout"' : ''; ?>>
    	<td><?php echo $m['fname'].' '.$m['lname'];?></td>
        <td><?php echo $m['membertype'];?></td>
        <td><?php echo $m['year']; ?></td>
        <td><?php echo ($m['year'] == date('Y')) ? $m['email'] : ''; ?></td>
        <td><?php echo ($m['year'] == date('Y')) ? $m['phone'] : ''; ?></td>
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
			<th style="width: 250px;">Rum</td>
			<th style="width: 100px;">År</td>
		</tr>
	</thead>
	<tbody>
		<?php  foreach($homerooms as $h){ ?>
		<tr <?php echo ($m['year'] != date('Y')) ? 'class="greyout"' : ''; ?>>
			<td><?php echo $h['room']; ?></td>
			<td><?php echo $h['year']; ?></td>
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
			<th style="width: 250px;">Vem</td>
			<th style="width: 100px;">Telefon</td>
			<th style="width: 100px;">Start</td>
			<th style="width: 100px;">Slut</td>
			<th style="width: 100px;">Prioritet</td>
		</tr>
	</thead>
	<tbody>
		<?php  foreach($responsibilities as $r){ ?>
		<tr>
			<td><?php echo $r['fname'].' '. $r['lname']; ?></td>
			<td><?php echo $r['phone']; ?></td>
			<td><?php echo date('Y-m-d H:i', $r['start']); ?></td>
			<td><?php echo date('Y-m-d H:i', $r['end']); ?></td>
			<td><?php echo $r['priority']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
<div style="position: fixed; top: 200px; left: 300px; background: lightGreen; padding: 10px;" id="editBox" class="preHidden">
	<form action="/me/groupDetails/<?=$group['id']; ?>" method="post">
		<?php echo Form::hidden('group_id', $group['id'])
		           .Form::label('user', 'Phösare')
            	   .Form::select('user', $resp)
            	   .Form::label('priority', 'Prioritet')
        		   .Form::input('priority', '1')
        		   .View::factory('datetimepicker')->set('field', 'start')
        		   .View::factory('datetimepicker')->set('field', 'end')
        		   .Form::submit('save', 'Spara')
        		   .Form::close()
		           .Form::button('abort','Avbryt', array('onclick' => 'hideEditBox()')); ?>
</div>