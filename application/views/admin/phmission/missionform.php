<h1>Nytt Phösaruppdrag</h1>
<?=Form::open('/admin/phmission/edit/'.$mission_id, array('method' => 'post')); ?>
<?=Form::hidden('mission_id', ((isset($mission_id))?$mission_id:'new')); ?>
<?=Form::label('name', 'Namn'); ?>
<?=Form::input('name',(isset($mission['name'])?$mission['name']:'')); ?>

<?=Form::label('description', 'Beskrivning'); ?>
<?=Form::textarea('description', (isset($mission['description'])?$mission['description']:'')); ?>

<?=Form::label('', 'Startdatum'); ?>
<?=View::factory('datetimepicker')->set('field', 'starttime')->set('date', (isset($mission['startdate'])?$mission['startdate']:false)); ?>

<?=Form::label('', 'Slutdatum'); ?>
<?=View::factory('datetimepicker')->set('field', 'endtime')->set('date', (isset($mission['enddate'])?$mission['enddate']:false)); ?>

<?=Form::submit('', (($mission_id == 'new') ? 'Skapa': 'Uppdatera')); ?>
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
			<td>mod</td>
		</tr>
	<? } ?>
	</tbody>
</table>
<? } ?>