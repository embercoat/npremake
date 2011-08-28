<?php
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
if($itemId != "new")
    $item = menu::get_item($itemId);
else 
    $item = array();
$groups = menu::get_groups();
?>
<form action="/admin/menu/<?=$action.'/'.((isset($itemId))?$itemId:"") ?>/" method="post">
<?=Form::hidden('id', Arr::get($item, 'id', 'new'))."\r\n" ?>

<?=Form::label('title', 'Title')."\r\n" ?>
<?=Form::input('title', Arr::get($item, 'title', ''), array('id' => 'title'))."\r\n" ?>

<?=Form::label('url', 'Url')."\r\n" ?>
<?=Form::input('url', Arr::get($item, 'url', ''))."\r\n" ?>

<?=Form::label('visible', 'Visible?')."\r\n" ?>
<?=Form::checkbox('visible', '1', (bool)Arr::get($item, 'visible', ''))."\r\n" ?>

<?=Form::label('requireLogin', 'Require Login?')."\r\n" ?>
<?=Form::checkbox('requireLogin', '1', (bool)Arr::get($item, 'requireLogin', ''))."\r\n" ?>

<?=Form::label('requireAdmin', 'Require Admin?')."\r\n" ?>
<?=Form::checkbox('requireAdmin', '1', (bool)Arr::get($item, 'requireAdmin', ''))."\r\n" ?>

<?=Form::label('group', 'Group')."\r\n" ?>
<?=Form::select('group', menu::get_groups(), Arr::get($item, 'group', '')) ?>

<?=Form::label('sortorder', 'SortOrder')."\r\n" ?>
<?=Form::input('sortorder', Arr::get($item, 'sortorder', ''))."\r\n" ?>

<?=Form::submit('save', 'Save')?>
</form>
<script type="text/javascript">
	document.getElementById('title').focus();
</script>