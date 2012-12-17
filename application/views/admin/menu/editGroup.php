<?php
/**
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 */
$group = menu::get_group($groupId);
if(count($group) > 0){
    $group = $group[0];
}
?>
<form action="/admin/menu/<?=$action.'/'.((isset($groupId))?$groupId:"") ?>/" method="post">
<?=Form::hidden('id', Arr::get($group, 'id', 'new'))."\r\n" ?>

<?=Form::label('title', 'Title')."\r\n" ?>
<?=Form::input('title', Arr::get($group, 'title'), array('id' => 'title'))."\r\n"; ?>

<?=Form::label('sortorder', 'SortOrder')."\r\n" ?>
<?=Form::input('sortorder', Arr::get($group, 'sortorder'))."\r\n" ?>

<?=Form::submit('save', 'Save')?>

</form>
<script type="text/javascript">
	document.getElementById('title').focus();
</script>