<?php
echo Form::open('/me/changepassword')

    .Form::label('oldpassword', 'Nuvarande Lösenord')
    .Form::password('oldpassword')

    .Form::label('newpassword', 'Nytt Lösenord')
    .Form::password('newpassword')

    .Form::label('newpassword2', 'Nytt lösenord igen')
    .Form::password('newpassword2')

    .Form::submit('', 'Byt Lösenord')
    .Form::close();
?>