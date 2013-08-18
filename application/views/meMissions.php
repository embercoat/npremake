<h1>Deltar i:</h1>
<table>
	<thead>
		<tr>
			<th style="width:100px;">Uppdrag</th>
			<th style="width:150px;">Start</th>
			<th style="width:150px;">Slut</th>
			<th style="width:150px;">Reserv?</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($missions as $m){ ?>
		<tr>
			<td><a href="/me/missionDetails/<?php echo $m['id']; ?>"><?php echo $m['name']; ?></a></td>
			<td><?php echo date('d M Y h:i', $m['startdate']); ?></td>
	    	<td><?php echo date('d M Y h:i', $m['enddate']); ?></td>
	    	<td><?php echo (($m['spare'] == 1) ? 'Reserv' : ''); ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<br /><br />
<h1>Ansvarig för:</h1>
<p>Genom organisation</p>
<table>
	<thead>
		<tr>
			<th style="width:100px;">Uppdrag</th>
			<th style="width:150px;">Start</th>
			<th style="width:150px;">Slut</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($responsible_missions as $m){ ?>
		<tr>
			<td><a href="/me/missionDetails/<?=$m['id']; ?>"><?php echo $m['name']; ?></a></td>
			<td><?php echo date('d M Y h:i', $m['startdate']); ?></td>
	    	<td><?php echo date('d M Y h:i', $m['enddate']); ?></td>		</tr>
		<?php } ?>
	</tbody>
</table>
