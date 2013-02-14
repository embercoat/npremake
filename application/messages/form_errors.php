<?php
return array (
  'fname' => array (
        'not_empty' => 'Förnamn får inte vara tomt',
    ),
    'lname' => array (
        'not_empty' => 'Efternamn får inte vara tomt',
    ),
    'phone' => array (
        'not_empty' => 'Telefon får inte vara tomt',
    ),
    'socialsecuritynumber' => array (
        'check_ssn' => 'Du måste ange ett giltigt personnummer (10 siffror)',
        'not_empty' => 'Personnummer får inte vara tomt',
    ),
    'email' => array (
        'not_empty' => 'Epost får inte vara tomt',
        'email' => 'Du måste ange en giltig epostadress',
    ),
    'reg_username' => array(
        'min_length' => 'Ditt användarnamn är för kort. (minst 6 tecken)',
        'user::free_username' => 'Det användarnamnet är redan taget.',
        'not_empty' => 'Användarnamn får inte vara tomt',
    ),
    'reg_password' => array(
        'min_length' => 'Ditt lösenord är för kort. (minst 6 tecken)',
        'not_empty' => 'Lösenord får inte vara tomt',
        'matches' => 'Lösenorden stämmer inte',
    ),
    'tos' => array(
        'not_empty' => 'Du måste acceptera våra Terms of Service (Användarvillkor)',
    ),
    'newpassword' => array(
            'not_empty' => 'Lösenord får inte vara tomt',
            'matches' => 'Lösenorden stämmer inte',
            'min_length' => 'Ditt lösenord är för kort. (minst 6 tecken)',
    ),
    'oldpassword' => array(
            'check_password' => 'Ditt nuvarande lösenord stämmer inte',
    ),
);
