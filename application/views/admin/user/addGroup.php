<?php
echo Form::open('/admin/user/editGroup/new')
    .Form::hidden('groupid', 'new')

    .Form::label('name', 'Namn')
    .Form::input('name', '')

    .Form::label('shortname', 'Kortnamn')
    .Form::input('shortname', '')

    .Form::label('union', 'Kår')
    .Form::input('union', '')

    .Form::submit('', 'Spara')
?>
</form>