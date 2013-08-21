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
				<?php echo $missionDetails['name']; ?>
			</td>
			<td>
				<h1>Ansvarig Organisation:</h1>
				<a href="/organisation/Details/<?php echo $missionDetails['responsible_organisation']; ?>">
				    <?php echo $missionDetails['organisation_name']; ?>
				</a>
			</td>
		</tr>
		<tr>
			<td>
				<h1>Starttid:</h1>
				<?php echo date('d M Y H:i', $missionDetails['startdate']); ?>
			</td>
			<td>
				<h1>Sluttid:</h1>
				<?php echo date('d M Y H:i', $missionDetails['enddate']); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<h1>Beskrivning:</h1>
				<?php echo $missionDetails['description']; ?>
			</td>
		</tr>
	</tbody>
</table>
<?php if(!empty($users)){ ?>
<table style="float: left; clear: both;">
	<thead>
		<tr>
			<th style="width: 200px;">Namn</th>
			<th style="width: 200px;">Telefonnummer</th>
			<th style="width: 200px;">Reserv?</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($users as $u){ ?>
		<tr>
			<td><?php echo $u['name']; ?></td>
			<td><?php echo $u['phone']; ?></td>
			<td><?php echo (($u['spare'] == 1) ? 'Reserv' : ''); ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<?php } ?>