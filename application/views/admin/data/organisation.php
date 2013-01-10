<a href="/admin/data/editOrganisation/new">Lägg till Organisation</a>
<table>
<thead>
	<tr>
		<th style="width: 150px;">Namn</th>
		<th style="width: 150px;">Typ</th>
		<th style="width: 150px;">Modify</th>
	</tr>
</thead>
<tbody>
<?
foreach($organisations as $o){ ?>
    <tr>
    	<td><?=$o['name']; ?></td>
    	<td><?=$o['typename']; ?></td>
    	<td>
     		<a href="/admin/data/delOrganisation/<?=$o['id'].'/'; ?>"><img src="/images/icon/red_x.svg" height="14px" /></a>
			<a href="/admin/data/editOrganisation/<?=$o['id'].'/'; ?>"><img src="/images/icon/edit.gif" /></a>
		</td>
    </tr>
<? } ?>
</tbody>
</table>