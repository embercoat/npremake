<style type="text/css">
    label, input[type=checkbox] {
        float: left;
    }
    .fields td{
        width: 200px;
    }
</style>
<?php
echo Form::open('/admin/list/gen');
?>
<h2>Fält</h2>
<table class="fields">
    <tbody>
        <tr>
    <?php
    $counter = 0;
    foreach($checkboxes as $key => $name){ ?>
        <td><?php echo Form::checkbox('sel[]', $key).Form::label($key, $name); ?></td>
        <?php if($counter%2 == 1){?></tr><tr><?php }?>
    <?php
    $counter++;
    }?>
    </tbody>
</table>

<h2>Krav</h2>
<table class="conditions">
    <tbody>
        <tr><td><?php echo Form::checkbox('cond[isPhosare]', '1').Form::label('cond[isPhosare]', 'Är Phösare'); ?></td></tr>
        <tr><td><?php echo Form::checkbox('cond[isCPh]', '1').Form::label('cond[isCPh]', 'Är CPh'); ?></td></tr>
        <tr><td><?php echo Form::checkbox('cond[isNPG]', '1').Form::label('cond[isNPG]', 'Är NPG'); ?></td></tr>
        <tr><td><?php echo Form::checkbox('cond[isNotChosen]', '1').Form::label('cond[isNotChosen]', 'Är Ej Vald'); ?></td></tr>
    </tbody>
</table>
<?php
echo Form::submit('', 'Do some Magic!')?>