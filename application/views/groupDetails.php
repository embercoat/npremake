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
foreach($members as $m){
    ?>
    <tr>
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
		<tr>
			<td><?=$h['room']; ?></td>
			<td><?=$h['year']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>