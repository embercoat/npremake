<form action="/admin/user/editGroup/new" method="post">
<?=Form::hidden('groupid', 'new');?>

<?=Form::label('name', 'Namn'); ?>
<?=Form::input('name', '')?>

<?=Form::label('shortname', 'Kortnamn'); ?>
<?=Form::input('shortname', '')?>

<?=Form::submit('', 'Spara');?>
</form>