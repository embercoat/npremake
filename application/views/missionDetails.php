<style type="text/css">
td {
	font-size: 16px;
}
</style>
<table style="width: 100%; border: 1px solid black;">
	<tbody>
		<tr>
			<td>
				<h1>Uppdrag:</h1>
				<?=$missionDetails['name']; ?>
			</td>
			<td>
				<h1>Ansvarig Organisation:</h1>
				<a href="/organisation/Details/<?=$missionDetails['responsible_organisation']; ?>">
				    <?=$missionDetails['organisation_name']; ?>
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<h1>Starttid:</h1>
				<?=date('d M Y h:i', $missionDetails['startdate']); ?>
			</td>
			<td>
				<h1>Sluttid:</h1>
				<?=date('d M Y h:i', $missionDetails['startdate']); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<h1>Beskrivning:</h1>
				<?=$missionDetails['description']; ?>
			</td>
		</tr>
	</tbody>
</table>
<? if(!empty($users)){ ?>
<table style="float: left; clear: both;">
	<thead>
		<tr>
			<th style="width: 200px;">Namn</th>
			<th>Telefonnummer</th>
		</tr>
	</thead>
	<tbody>
	<? foreach($users as $u){ ?>
		<tr>
			<td><?=$u['name']; ?></td>
			<td><?=$u['phone']; ?></td>
		</tr>
	<? } ?>
	</tbody>
</table>
<? } ?>