<dl>
<? foreach($organisations as $o){ ?>
	<dt><a href="/organisation/details/<?=$o['id']; ?>"><?=$o['name']; ?></a></dt>
	<dd><?=$o['description']; ?></dd>
<? } ?>
</dl>