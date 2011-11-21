<table>
	<thead>
		<tr>
			<td style="width:150px;">Phösare</td>
			<td style="width:150px;">Grupp</td>
			<td style="width:150px;">Telefon</td>
			<td style="width:150px;">Start</td>
			<td style="width:150px;">Slut</td>
			<td style="width:150px;">Prioritet</td>
		</tr>
	</thead>
	<tbody>
		<?php
		    foreach($responsible as $r){ 
		?>
		<tr>
			<td><?=$r['fname'].' '.$r['lname'];?></td>
			<td><?=$r['name']; ?></td>
			<td><?=$r['phone']; ?></td>
			<td><?=date('Y-m-d H:i', $r['start']); ?></td>
			<td><?=date('Y-m-d H:i', $r['end']); ?></td>
			<td><?=$r['priority']; ?></td>
		</tr>
		<?php  } ?>
	</tbody>
</table>