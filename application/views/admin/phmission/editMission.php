<h1>Nytt Phösaruppdrag</h1>
<?=Form::open('/admin/phmission/edit/'.((isset($mission_id))?$mission_id:'new'), array('method' => 'post')); ?>
<p>
<?=Form::hidden('mission_id', ((isset($mission_id))?$mission_id:'new')); ?>
<?=Form::label('name', 'Namn'); ?>
<?=Form::input('name',(isset($mission['name'])?$mission['name']:'')); ?>

<?=Form::label('responsible_organisation', 'Ansvarig Organisation'); ?>
<?=Form::select('responsible_organisation', $organisations, (isset($mission['responsible_organisation'])?$mission['responsible_organisation']:'')); ?>

<?=Form::label('description', 'Beskrivning'); ?>
<?=Form::textarea('description', (isset($mission['description'])?$mission['description']:'')); ?>

<?=Form::label('starttime', 'Startdatum'); ?>
<?=View::factory('datetimepicker')->set('field', 'starttime')->set('date', (isset($mission['startdate'])?$mission['startdate']:false)); ?>

<?=Form::label('starttime[hour]', 'Starttid'); ?>
<?=Form::select('starttime[hour]', array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23'), NULL, array('style="clear: left; width: 50px;"'))?>
<?=Form::select('starttime[minute]', array('00','15','30','45'), NULL, array('style="clear: right; width: 50px;"'))?>

<?=Form::label('endtime', 'Slutdatum'); ?>
<?=View::factory('datetimepicker')->set('field', 'endtime')->set('date', (isset($mission['enddate'])?$mission['enddate']:false)); ?>

<?=Form::label('endtime[hour]', 'Sluttid'); ?>
<?=Form::select('endtime[hour]', array('00','01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23'), NULL, array('style="clear: left; width: 50px;"'))?>
<?=Form::select('endtime[minute]', array('00','15','30','45'), NULL, array('style="clear: right; width: 50px;"'))?>

<?=Form::submit('button', (($mission_id == 'new') ? 'Skapa': 'Uppdatera')); ?>
</p>
<?=Form::close(); ?>

<? if(!empty($users)){ ?>
<table style="float: left; clear: both;">
	<thead>
		<tr>
			<th style="width: 200px;">Name</th>
			<th>Modify</th>
		</tr>
	</thead>
	<tbody>
	<? foreach($users as $u){ ?>
		<tr>
			<td><?=$u['name']; ?></td>
			<td>
				<a href="/admin/phmission/rmUser/<?=$mission_id; ?>/<?=$u['user_id']; ?>/">
					<img src="/images/icon/red_x.svg" height="14px"; />
				</a>
			</td>
		</tr>
	<? } ?>
	</tbody>
</table>
<? } ?>