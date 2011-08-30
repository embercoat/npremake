<?php
/**
 * 
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
?>
<form action="/register/commit/" method="post">

<?=Form::label('fname', 'Förnamn')."\r\n" ?>
<?=Form::input('fname')?>

<?=Form::label('lname', 'Efternamn')."\r\n" ?>
<?=Form::input('lname') ?>

<?=Form::label('reg_username', 'Användarnamn')."\r\n" ?>
<?=Form::input('reg_username')?>

<?=Form::label('reg_password', 'Lösenord')."\r\n" ?>
<?=Form::password('reg_password') ?>

<?=Form::label('password2', 'Lösenord Igen')."\r\n" ?>
<?=Form::password('password2') ?>

<?=Form::label('tos', 'Jag har läst och accepterar ToS för nolleperioden.se'); ?>
<?=Form::checkbox('tos', '1'); ?>

<?=Form::submit('save', 'Save')?>
</form>
<script type="text/javascript">
	document.getElementById('fname').focus();
</script>