<table>
<thead>
	<tr>
		<th style="width: 300px;">Name</th>
		<th style="width: 100px;">Modify</th>
	</tr>
</thead>
<tbody>
	<? foreach($documents as $d) { ?>
	<tr>
		<td><?=$d['name']; ?></td>
		<td>
			<a href="/admin/document/edit/<?=$d['id']; ?>"><img src="/images/icon/edit.gif" /></a>
        	<a href="/admin/document/del/<?=$d['id']; ?>"><img src="/images/icon/red_x.svg" height="14px"; /></a>
		</td>
	</tr>
	<? } ?>
</tbody>
</table>