<table>
	<thead>
		<tr>
			<th style="width: 200px;">Namn</th>
			<th style="width: 400px;">Beskrivning</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($documents as $d){ ?>
		<tr>
			<td><a href="/document/download/<?=$d['id']; ?>"><?=$d['name']; ?></a></td>
			<td><?=$d['description']; ?></td>
		</tr>
		<? } ?>
	</tbody>
</table>