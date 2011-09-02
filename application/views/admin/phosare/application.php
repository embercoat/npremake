<h1>Application Data</h1>
<table>
	<tr>
		<td style="width: 150px;"><b>Timestamp</b></td>
		<td style="width: 150px;"><?=date('d M Y h:i', $application_data['timestamp']); ?></td>
		<td style="width: 150px;"><b>Approved</b></td>
		<td style="width: 150px;"><?=(($application_data['approved'] == 1) ? 'Yes' : 'No' ); ?></td>
	</tr>
	<tr>
		<td colspan="4"><b>Motivation</b></td>
	</tr>
	<tr>
		<td colspan="4"><?=$application_data['whyphosa']; ?></td>
	</tr>
</table>
<br />
<h1>Userdata</h1>
<table>
  	<tr>
    	<td style="width: 200px;"><b>Name</b></td>
    	<td style="width: 250px;"><?=$user_data['fname'].' '.$user_data['lname']; ?></td>
  	</tr>
  	<tr>
		<td><b>Phone</b></td>
		<td><?=$user_data['phone']; ?></td>
  	</tr>
  	<tr>
		<td><b>Email</b></td>
		<td><?=$user_data['email']; ?></td>
  	</tr>
  	<tr>
		<td><b>Socialsecurity number</b></td>
		<td><?=$user_data['socialsecuritynumber']; ?></td>
  	</tr>
  	<?
  	$critical_fields = array('socialsecuritynumber', 'email', 'phone');
  	$all_good = true;
  	foreach($critical_fields as $cf)
  	    if(empty($user_data[$cf]))
  	        $all_good = false;
  	
  	if($all_good){ ?>
  	<tr style="background-color: lightgreen">
		<td><b>Critical info</b></td>
		<td>All Good</td>
  	</tr>
  	<? } else { ?>
    <tr style="background-color: salmon">
		<td><b>Critical info</b></td>
		<td>Pieces missing</td>
  	</tr>
  	<? } ?>
</table>
<br />
<h1>Groups</h1>
<table>
	<thead>
		<tr>
			<th style="width: 150px;">Group</th>
			<th style="width: 150px;">Membertype</th>
			<th style="width: 150px;">Year</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($groups as $g){ ?>
	    <tr>
	    	<td><?=$g['groupname']; ?></td>
	    	<td><?=$g['membertype']; ?></td>
	    	<td><?=$g['year']; ?></td>
	    </tr>
	<? } ?>
	</tbody>
</table>
<br />
<?
$all_groups = array();
foreach(user::get_group() as $g)
    $all_groups[$g['id']] = $g['name'];
    
$all_membertypes = array();
foreach(user::get_membertype() as $mt)
    $all_membertypes[$mt['id']] = $mt['name'];
?>

<form action="/admin/phosare/approveApplication/" method="post">
<?=Form::hidden('applicationid', $application_data['id']); ?>
<?=Form::hidden('userid', $application_data['userid']); ?>
<?=Form::label('addToGroup', 'Lägg till i:'); ?>
<?=Form::select('addToGroup', $all_groups); ?>

<?=Form::label('asMemberType', 'Med rollen:'); ?>
<?=Form::select('asMemberType', $all_membertypes); ?>
	
<?=Form::submit('', 'Godkänn'); ?>
</form>