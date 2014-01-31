<h1>Application Data</h1>
<table>
	<tr>
		<td style="width: 150px;"><b>Timestamp</b></td>
		<td style="width: 150px;"><?php echo date('d M Y h:i', $application_data['timestamp']); ?></td>
		<td style="width: 150px;"><b>Approved</b></td>
		<td style="width: 150px;"><?php echo (($application_data['approved'] == 1) ? 'Yes' : 'No' ); ?></td>
	</tr>
	<tr>
		<td style="width: 150px;"><b>CPh</b></td>
		<td style="width: 150px;"><?php echo (($application_data['cph'] == 1) ? 'Ja': 'Nej'); ?></td>
		
		<td style="width: 150px;"><b>Program</b></td>
		<td style="width: 150px;"><?php echo $programs[$application_data['program']]; ?></td>
	</tr>

	<tr>
		<td colspan="4"><b>Motivation</b></td>
	</tr>
	<tr>
		<td colspan="4"><?php echo $application_data['whyphosa']; ?></td>
	</tr>
	<tr>
		<td colspan="4"><b>Phösargrupp</b></td>
	</tr>
	<tr>
		<td colspan="4"><?php echo $application_data['phosbuddy']; ?></td>
	</tr>
	<tr>
		<td colspan="4"><b>Studerar</b></td>
	</tr>
	<tr>
		<td colspan="4"><?php echo $application_data['klass']; ?></td>
	</tr>
	<tr>
		<td colspan="4"><b>Studentikåsa engagemang</b></td>
	</tr>
	<tr>
		<td colspan="4"><?php echo $application_data['studentikosa']; ?></td>
	</tr>
	<tr>
		<td style="width: 150px;"><b>Phöst tidigare</b></td>
		<td style="width: 150px;"><?php echo (($application_data['phosHistoryBox'] == 1) ? 'Ja': 'Nej'); ?></td>
		
		<td style="width: 150px;"><b>Phöst år</b></td>
		<td style="width: 150px;"><?php echo $application_data['phosHistory']; ?></td>
	</tr>
	<tr>
	<td style="width: 150px;"><b>Tycker grupp är viktigare än klass</b></td>
	<td style="width: 150px;"><?php echo (($application_data['importantMe'] == 1) ? 'Ja': 'Nej'); ?></td>
	<td style="width: 150px;"><b>Kårmedlem</b></td>
	<td style="width: 150px;"><?php echo (($application_data['union'] == 1) ? 'Ja': 'Nej'); ?></td>
	</tr>
</table>
<br />
<h1>Userdata</h1>
<table>
  	<tr>
    	<td style="width: 200px;"><b>Name</b></td>
    	<td style="width: 250px;"><?php echo $user_data['fname'].' '.$user_data['lname']; ?></td>
  	</tr>
  	<tr>
		<td><b>Phone</b></td>
		<td><?php echo $user_data['phone']; ?></td>
  	</tr>
  	<tr>
		<td><b>Email</b></td>
		<td><?php echo $user_data['email']; ?></td>
  	</tr>
	<tr>
		<td><b>Kårtillhörlighet</b></td>
		<td><?php 
			if($user_data['union'] == 1){
				echo 'LS';
			}else if($user_data['union'] == 2){
				echo 'TKL';
			}else{
				echo 'Fristående';
			}
			?></td>
  	</tr>
	<tr>
		<td><b>STUK-lag</b></td>
		<td><?php echo $user_data['karworker']; ?></td>
  	</tr>
  	<tr>
		<td><b>Socialsecurity number</b></td>
		<td><?php echo $user_data['socialsecuritynumber']; ?></td>
  	</tr>
  	<?php
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
  	<?php } else { ?>
    <tr style="background-color: salmon">
		<td><b>Critical info</b></td>
		<td>Pieces missing</td>
  	</tr>
  	<?php } ?>
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
	    	<td><?php echo $g['groupname']; ?></td>
	    	<td><?php echo $g['membertype']; ?></td>
	    	<td><?php echo $g['year']; ?></td>
	    </tr>
	<?php } ?>
	</tbody>
</table>
<br />
<?php
$all_groups = array();
foreach(user::get_group() as $g)
    $all_groups[$g['id']] = $g['name'];

$all_membertypes = array();
foreach(user::get_membertype() as $mt)
    $all_membertypes[$mt['id']] = $mt['name'];

echo Form::open('/admin/phosare/approveApplication/', array('method'=>'post'))
    .Form::hidden('applicationid', $application_data['id'])
    .Form::hidden('userid', $application_data['userid'])
    .Form::label('addToGroup', 'Lägg till i:')
    .Form::select('addToGroup', $all_groups)

    .Form::label('asMemberType', 'Med rollen:')
    .Form::select('asMemberType', $all_membertypes)

    .Form::submit('', 'Godkänn'); ?>
</form>