<ul style="list-style: none;">
    <li style="display: inline;"><a href="/admin/phosare/applicants">Årets icke behandlade</a></li>
    <li style="display: inline;"><a href="/admin/phosare/applicantshistory/">Årets samtliga</a></li>
    <?php
    for($year = $firstYear['year'];$year<date('Y');$year++) {?>
    <li style="display: inline;"><a href="/admin/phosare/applicantshistory/<?php echo $year; ?>"><?php echo $year; ?> samtliga</a></li>
    <?php } ?>
</ul>
<table>
	<thead>
		<tr>
			<th style="width: 200px">Ansökare</th>
			<th style="width: 250px">Program</th>
			<th style="width: 100px">CPh</th>
			<th style="width: 80px">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($applications as $a){ ?>
	    <tr>
	        <td><?php echo $a['name'] ?></td>
	        <td><?php echo $programs[$a['program']]; ?></td>
	        <td><?php echo (($a['cph'] == 1) ? 'Ja' : 'Nej'); ?></td>
	        <td><a href="/admin/phosare/applicants/<?php echo $a['id']; ?>">Visa</a></td>
	    <?php } ?>
	</tbody>
</table>
