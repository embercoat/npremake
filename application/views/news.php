<? foreach(Model::factory('news')->get_news(5) as $news){ ?>
<div class="story">
	<h1><?=$news['title']; ?></h1>
	<p class="date"><?=date('Y-m-d h:i', $news['published']); ?></p>
	<?=$news['text']; ?>
</div>
<? } ?>