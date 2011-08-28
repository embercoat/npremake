<?php

//Get the stuff from /application/classes/menu.php
$items = menu::get_items();
$groups = menu::get_groups();

foreach($groups as $id => $title){
    if(isset($items[$id])){
        ?>
<div class="group">
	<b><?=$title?></b><br />
	<div class="subgroup">
		<ul>
<? foreach($items[$id] as $item){ ?>
			<li><a href="<?=$item['url']?>"><?=$item['title']?></a></li>
<? } ?>
		</ul>
	</div>
</div>
<?
    }
}
?>