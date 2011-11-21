<?php
$date = (isset($date)?$date:time());
$date = Model::factory('general')->round_custom($date, 15*60);
?>
<?=Form::input($field, $date); ?>
<?=Form::input($field.'_timeholder'); ?>
<div style="float: left; clear: both; margin-bottom: 20px;">
	<script type="text/javascript">
	$(document).ready(function(){
		$('#<?=$field; ?>_datepicker').datepicker({
			changeMonth: true,
			changeYear: true,
			defaultDate: "<?=(($date)?date('m/d/y', $date): 'now'); ?>",
			onSelect : function(dateText, inst)
		    {
		        var epoch = $.datepicker.formatDate('@', $('#<?=$field; ?>_datepicker').datepicker('getDate')) / 1000;
		        var time = parseInt($('#<?=$field; ?>_timeholder').val());
		        if(!isNaN(time)){
			        $('#<?=$field; ?>').val(epoch+time);
		        } else {
		        	$('#<?=$field; ?>').val(epoch);
		        }
		    }
		});
		
		$('#<?=$field; ?>_timepicker').timepicker({
			showPeriodLabels: false,
			defaultTime: '<?=(($date)?date('H:i', $date): 'now'); ?>', 
			minutes: {
				starts: 0,
				interval: 15
			}, 
			onSelect: function(time, inst) {
				var hour =  parseInt(inst.hours);
				var min = parseInt(inst.minutes);
				var timeEpoch = ((hour*60)+min)*60;
				var epoch = $.datepicker.formatDate('@', $('#<?=$field; ?>_datepicker').datepicker('getDate')) / 1000;
				$('#<?=$field; ?>').val((epoch+timeEpoch));
				$('#<?=$field; ?>_timeholder').val(timeEpoch);
		        
		    }	
		});
	});
	</script>
	<div id="<?=$field; ?>_datepicker" style="float: left;"></div>
	<div id="<?=$field; ?>_timepicker" style="float: left;"></div>
</div>