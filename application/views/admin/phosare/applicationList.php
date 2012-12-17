<table>
	<thead>
		<tr>
			<th>Ansökare</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($applications as $a){ ?>
	    <tr>
	        <td><?=$a['name'] ?></td>
	        <td><a href="/admin/phosare/applicants/<?=$a['id']; ?>">Visa</a></td>
	    <? } ?>
	</tbody>
</table>

<?php



?>