<table>
<thead>
	<tr>
		<td style="width: 200px;">Page</td>
		<td style="width: 150px;">Last modified</td>
		<td style="width: 100px;">Modified by</td>
		<td style="width: 100px;">Modify</td>
	</tr>
</thead>
<tbody>
<?php 
foreach($dynamics as $d){
?>
    <tr>
    	<td><?=$d['page'];?></td>
    	<td><?=date('j F Y h:i:s', $d['edited']);?></td>
    	<td><?=user::get_username_by_id($d['edited_by']);?></td>
    	<td><a href="/dynamic/<?=$d['page'];?>/edit"><img src="/images/icon/edit.gif" /></a></td>
   	</tr>
<?
}

?>
</tbody>
</table>