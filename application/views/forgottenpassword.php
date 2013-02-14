<p>Vänligen fyll i din epost för att generera ett nytt lösenord.</p>
<?php
echo Form::open('/forgottenpassword/')
    .Form::label('email', 'Epost')
    .Form::input('email')
    .Form::submit('', 'Skicka')
    .Form::close();


?>