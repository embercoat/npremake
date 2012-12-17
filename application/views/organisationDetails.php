<h1><?=$details['name']; ?></h1>
<h2><?=$details['type']; ?></h2>
<?=$details['description']; ?>
<table>
	<thead>
		<tr>
			<th style="width: 150px">Namn</th>
			<th style="width: 150px">Titel</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($members as $m) { ?>
		<tr>
			<td><?=$m['fname'] .' '.$m['lname']; ?></td>
			<td><?=$m['title']; ?></td>
		</tr>
		<? } ?>
	</tbody>
</table>