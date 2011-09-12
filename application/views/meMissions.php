<table>
	<thead>
		<tr>
			<th style="width:100px;">Uppdrag</th>
			<th style="width:100px;">Start</th>
			<th style="width:100px;">Slut</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($missions as $m){ ?>
		<tr>
			<td><?=$m['name']; ?></td>
			<td><?=$m['startdate']; ?></td>
			<td><?=$m['enddate']; ?></td>
		</tr>
		<? } ?>
	</tbody>
</table>