<div id="groups">
	<table>
		<thead>
			<tr>
				<td style="width:250px;">Group</td>
				<td style="width:100px;">Membertype</td>
				<td style="width:100px;">Year</td>
			</tr>
		</thead>
		<tbody>
		<? foreach($groups as $g){ ?>
			<tr>
				<td><a href="/me/groupDetails/<?=$g['groupid']; ?>"><?=$g['groupname']?></a></td>
				<td><?=$g['membertype']?></td>
				<td><?=$g['year']?></td>
			</tr>
		<? } ?>
		</tbody>
	</table>
</div>