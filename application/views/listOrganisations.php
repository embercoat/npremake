<dl>
<?php foreach($organisations as $o){ ?>
	<dt><a href="/organisation/details/<?php echo $o['organisation_id']; ?>"><?php echo $o['name']; ?></a></dt>
	<dd><?php echo $o['description']; ?></dd>
<? } ?>
</dl>