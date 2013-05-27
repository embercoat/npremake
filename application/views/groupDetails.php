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
    if($m['year'] == date('Y'))
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
			<th style="width: 150px;">Start</td>
			<th style="width: 150px;">Slut</td>
			<th style="width: 100px;">Prioritet</td>
			<th style="width: 20px;">Delete</td>
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
			<td><a href="/me/delResponsibility/<?php echo $r['id'];?>"><img src="/images/icon/red_x.svg" height="14px"; /></a></td>

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

        		   .Form::select('starttime[month]', array( '01' => 'Januari', '02' => 'Februari', '03' => 'Mars', '04' => 'April', '05' => 'Maj', '06' => 'Juni', '07' => 'Juli', '08' => 'Augusti', '09' => 'September', '10' => 'Oktober', '11' => 'November','12' => 'December'), '08', array('style="clear: left; width: 100px;"'))
        		   .Form::select('starttime[day]', array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30', '31'), (isset($mission) ? date('d', $mission['startdate']) : ''), array('style="clear: none;width: 50px;"'))
        		   .Form::select('starttime[shift]', array('Dag 06-18', 'Natt 18-06'), '', array('style="clear: right; width: 150px;"'))

        		   //.View::factory('datetimepicker')->set('field', 'start')
        		   //.View::factory('datetimepicker')->set('field', 'end')
        		   .Form::submit('save', 'Spara')
        		   .Form::close()
		           .Form::button('abort','Avbryt', array('onclick' => 'hideEditBox()')); ?>
</div>