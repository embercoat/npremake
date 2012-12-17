<table>
<thead>
	<tr>
		<th style="width: 150px">Titel</th>
		<th style="width: 150px">Publicerad</th>
		<th style="width: 150px">Författare</th>
		<th style="width: 150px">&nbsp;</th>
	</tr>	
</thead>
<tbody>
	<? foreach(Model::factory('news')->get_news() as $news){ ?>
	<tr>
		<td><?=$news['title']; ?></td>
		<td><?=$news['published']; ?></td>
		<td><?=$news['author']; ?></td>
		<td>
			<a href="/admin/news/edit/<?=$news['id']; ?>">Edit</a>
			<a href="/admin/news/delete/<?=$news['id']; ?>">Radera</a>
		</td>
	</tr>
	<? } ?>
</tbody>
</table>