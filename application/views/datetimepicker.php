<?php
$date = (isset($date)?$date:time());
$date = Model::factory('general')->round_custom($date, 15*60);
?>
<?=Form::hidden($field.'[date]', $date); ?>
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
	        	$('#<?=$field; ?>').val(epoch);
		    }
		});
		
	});
	</script>
	<div id="<?=$field; ?>_datepicker" style="float: left;"></div>
</div>