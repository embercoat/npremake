<?php
echo Form::open('/admin/user/editGroup/new')
    .Form::hidden('groupid', 'new')

    .Form::label('name', 'Namn')
    .Form::input('name', '')

    .Form::label('shortname', 'Kortnamn')
    .Form::input('shortname', '')

    .Form::label('union', 'Kår')
    .Form::select('union', $unions)

    .Form::submit('', 'Spara')
?>
</form>