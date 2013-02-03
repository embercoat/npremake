<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
?>
<p>
<?php
    echo Form::open('/register/')
        .Form::label('fname', 'Förnamn')
        .Form::input('fname', ((!empty($details)) ? $details['fname'] : ''))

        .Form::label('lname', 'Efternamn')
        .Form::input('lname', ((!empty($details)) ? $details['lname'] : ''))

        .Form::label('socialsecuritynumber', 'Personnummer')
        .Form::input('socialsecuritynumber', ((!empty($details)) ? $details['socialsecuritynumber'] : ''))

        .Form::label('reg_username', 'Användarnamn')
        .Form::input('reg_username', ((!empty($details)) ? $details['reg_username'] : ''))

        .Form::label('email', "Epost")
        .Form::input('email', ((!empty($details)) ? $details['email'] : ''))

        .Form::label('reg_password', 'Lösenord')
        .Form::password('reg_password', ((!empty($details)) ? $details['reg_password'] : ''))

        .Form::label('password2', 'Lösenord Igen')
        .Form::password('password2',((!empty($details)) ? $details['reg_password'] : ''))

        .Form::label('tos', 'Jag har läst och accepterar <a href="/dynamic/tos" target="_blank">ToS</a> för nolleperioden.se')
        .Form::checkbox('tos', '1')

        .Form::submit('save', 'Save')
        .Form::close();
    ?>
</p>
<script type="text/javascript">
	document.getElementById('fname').focus();
</script>