<?php
$keys = array_keys($list_heads);
$designation = (isset($designation) ? $designation : false);
$sortable = (isset($sortable) ? $sortable : false);
if($designation)
    echo View::factory('designation/start');
if($sortable)
    echo View::factory('datatable/start')->set('target', 'sorttable');

?>

<table <?php if($sortable) echo 'id="sorttable" style="float: left;width: 100%;"'; ?>>
	<thead>
		<tr>
			<?php foreach($keys as $k){ ?>
			<th style="width: 150px;"><?php echo $list_heads[$k]; ?></th>
			<?php } ?>
			<?php if ($designation) { ?>
			    <th style="width:20px"></th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php  foreach($list as $l){ ?>
		<tr>
			<?php foreach($keys as $k) {
			    if($k != 'userid' && !$designation) { ?>
				<td><?php echo $l[$k]; ?></td>
			    <?php }
			}
		    if($designation){ ?>
			    <td><?php echo View::factory('designation/check')->set('userid', $l['userid']); ?></td>
			<?php } ?>
		</tr>
		<?php } ?>
	</tbody>
</table>
<?php
if($designation)
    echo View::factory('designation/end');
?>
