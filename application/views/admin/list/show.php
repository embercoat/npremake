<?php
/*array(7) {
	["idlist"]=> string(1) "1"
	["name"]=>	string(4) "test"
	["require_moderation"]=>	string(1) "0"
	["description"]=>	string(3) "asd"
	["visible"]=>	string(1) "1"
	["open"]=>	string(1) "1"
	["guests"]=>	array(1) {
		[0]=> array(6) {
			["id"]=> string(1) "1"
			["list_id"]=> string(1) "1"
			["user"]=> string(1) "1"
			["confirmed"]=> string(1) "1"
			["fname"]=> string(8) "Kristian"
			["lname"]=> string(7) "Nordman"
		}
	}
}*/
echo Form::open((!$create ? '/admin/list/list/'.$list['idlist']: '/admin/list/create'))
    .Form::label('name', 'Namn')
    .Form::input('name', (!$create ? $list['name']: ''))
    .Form::label('require_moderation', 'NPG godkänner?')
    .Form::checkbox('require_moderation', '1', (!$create ?($list['require_moderation'] == 1 ? true : false): false))
    .Form::label('visible', 'Synlig?')
    .Form::checkbox('visible', '1', (!$create ?($list['visible'] == 1 ? true : false): false))
    .Form::label('open', 'Öppen?')
    .Form::checkbox('open', '1', (!$create ?($list['open'] == 1 ? true : false): false))
    .Form::label('description', 'Beskrivning')
    .Form::textarea('description', (!$create ?$list['description']: ''))
    .Form::submit('', 'Uppdatera')
    .Form::close();
?>
