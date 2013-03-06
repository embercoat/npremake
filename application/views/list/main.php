<h1>Anmälningslistor</h1>
<?php foreach($lists as $l) {?>
<div class="list_entry">
<h2><?php echo $l['name']; ?></h2>
<p><?php echo $l['description']; ?></p>
<?php if (Model::factory('list')->is_participant($_SESSION['user']->getId(), $l['idlist']) == 1) { ?>
<p style="background-color: lightgreen">
    Du är anmäld
    <?php if($l['open'] == 1) { ?>
        <a href="/signup/unparticipate/<?php echo $l['idlist'];?>">Avanmäl dig</a><br />
    <?php } else { ?>
        Listan är stängd
    <?php } ?>
</p>
    <?php if($l['require_moderation'] == 1) { ?>
    Listan granskas av NPG. Din status: <?php echo (Model::factory('list')->is_confirmed($_SESSION['user']->getId(), $l['idlist']) == 1) ? 'Godkänd' : 'Ej ännu godkänd'; ?>
    <?php } ?>
<?php } else { ?>
<p style="background-color: lightcoral">
    Du är inte anmäld
    <?php if($l['open'] == 1) { ?>
        <a href="/signup/participate/<?php echo $l['idlist'];?>">Anmäl dig</a>
    <?php } else { ?>
        Listan är stängd
    <?php } ?>
</p>
<?php }?>

<hr>
</div>
<?php } ?>