<table>
	<thead>
		<tr>
			<th style="width:100px;">Uppdrag</th>
			<th style="width:150px;">Start</th>
			<th style="width:150px;">Slut</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($missions as $m){ ?>
		<tr>
			<td><a href="/me/missionDetails/<?=$m['id']; ?>"><?=$m['name']; ?></a></td>
			<td><?=date('d M Y h:i', $m['startdate']); ?></td>
	    	<td><?=date('d M Y h:i', $m['enddate']); ?></td>		</tr>
		<? } ?>
	</tbody>
</table>