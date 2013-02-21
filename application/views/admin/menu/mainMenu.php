<?php
$groups = menu::get_complete_groups();
?>
<h1>Items</h1>
<table>
<thead>
<tr>
	<td style="width: 150px;">Group</td>
	<td style="width: 200px;">Name</td>
	<td style="width: 60px;">Visible</td>
	<td style="width: 60px;">Login</td>
	<td style="width: 60px;">Phösare</td>
	<td style="width: 60px;">Admin</td>
	<td style="width: 50px;">Modify</td>
</tr>
</thead>
<tbody>
<?php
foreach(menu::get_items(true) as $group => $item){
    foreach($item as $i){
        echo '<tr>
        		<td>'.$groups[$i['group']]['title'].'</td>
        		<td>'.$i['title'].'</td>
        		<td style="background-color: '.(($i['visible'] == 1) ? 'lightgreen' : 'lightcoral').';">'.(($i['visible'] == 1) ? 'Yes' : 'No').'</td>
        		<td style="background-color: '.(($i['requireLogin'] == 1) ? 'lightgreen' : 'lightcoral').';">'.(($i['requireLogin'] == 1) ? 'Yes' : 'No').'</td>
        		<td style="background-color: '.(($i['requirePhosare'] == 1) ? 'lightgreen' : 'lightcoral').';">'.(($i['requirePhosare'] == 1) ? 'Yes' : 'No').'</td>
        		<td style="background-color: '.(($i['requireAdmin'] == 1) ? 'lightgreen' : 'lightcoral').';">'.(($i['requireAdmin'] == 1) ? 'Yes' : 'No').'</td>
        		<td>
        			<a href="/admin/menu/editItem/'.$i['id'].'"><img src="/images/icon/edit.gif" /></a>
        			<a href="/admin/menu/delItem/'.$i['id'].'"><img src="/images/icon/red_x.svg" height="14px"; /></a>
        		</td>
        	  </tr>';
    }
}
?>
</tbody>
</table>
<a href="/admin/menu/addItem/new/">Add Item</a><br /><br />
<h1>Groups</h1>
<table>
	<thead>
		<tr>
			<td style="width: 50px;">Id</td>
			<td style="width: 150px;">Title</td>
			<td style="width: 150px;">SortOrder</td>
			<td style="width: 50px;">Modify</td>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($groups as $g){
	    echo '<tr>
	    		<td>'.$g['id'].'</td>
	    		<td>'.$g['title'].'</td>
	    		<td>'.$g['sortorder'].'</td>
	    		<td>
        			<a href="/admin/menu/editGroup/'.$g['id'].'"><img src="/images/icon/edit.gif" /></a>
        			<a href="/admin/menu/delGroup/'.$g['id'].'"><img src="/images/icon/red_x.svg" height="14px"; /></a>
        		</td>
        	  </tr>';
	}
	?>
	</tbody>
</table>
<a href="/admin/menu/addGroup/">Add Group</a>