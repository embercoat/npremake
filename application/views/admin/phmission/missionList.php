<table>
	<thead>
		<tr>
			<th style="width: 150px">Name</th>
			<th style="width: 150px">Startime</th>
			<th style="width: 150px">Endtime</th>
			<th style="width: 150px">Modify</th>
		</tr>
	</thead>
	<tbody>
	<? foreach($missions as $mission) { ?>
	    <tr>
	    	<td><?=$mission['name']; ?></td>
	    	<td><?=date('d M Y h:i', $mission['startdate']); ?></td>
	    	<td><?=date('d M Y h:i', $mission['enddate']); ?></td>
	    	<td>
	    		<a href="/admin/phmission/edit/<?=$mission['id']; ?>"><img src="/images/icon/edit.gif" /></a>
        		<a href="/admin/phmission/delMission/<?=$mission['id']; ?>"><img src="/images/icon/red_x.svg" height="14px"; /></a>
        	</td>
	    </tr>
	<? } ?>
	</tbody>
</table>