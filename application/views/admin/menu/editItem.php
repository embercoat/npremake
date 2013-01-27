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

echo Form::open('/admin/menu/'.$action.'/'.((isset($itemId))?$itemId:"").'/')
    .Form::hidden('id', Arr::get($item, 'id', 'new'))

    .Form::label('title', 'Title')
    .Form::input('title', Arr::get($item, 'title', ''))

    .Form::label('url', 'Url')
    .Form::input('url', Arr::get($item, 'url', ''))

    .Form::label('visible', 'Visible?')
    .Form::checkbox('visible', '1', (bool)Arr::get($item, 'visible', ''))

    .Form::label('requireLogin', 'Require Login?')
    .Form::checkbox('requireLogin', '1', (bool)Arr::get($item, 'requireLogin', ''))

    .Form::label('requirePhosare', 'Require Phosare?')
    .Form::checkbox('requirePhosare', '1', (bool)Arr::get($item, 'requirePhosare', ''))

    .Form::label('requireAdmin', 'Require Admin?')
    .Form::checkbox('requireAdmin', '1', (bool)Arr::get($item, 'requireAdmin', ''))

    .Form::label('group', 'Group')
    .Form::select('group', menu::get_groups(), Arr::get($item, 'group', ''))

    .Form::label('sortorder', 'SortOrder')
    .Form::input('sortorder', Arr::get($item, 'sortorder', ''))

    .Form::submit('save', 'Save')
    .Form::close();
?>
<script type="text/javascript">
	document.getElementById('title').focus();
</script>