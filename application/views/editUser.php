<h1>Editing details for: <?=$details['username'];?></h1><br/>
<div id="details">
	<form action="<?=$formTarget?>" method="post">
		<?=Form::hidden('userid', $userId); ?>
		
		<?=Form::label('fname', "Förnamn");?>
		<?=Form::input('fname', $details['fname']); ?>
		
		<?=Form::label('lname', "Efternamn");?>
		<?=Form::input('lname', $details['lname']); ?>
		
		<?=Form::label('phone', "Telefonnummer");?>
		<?=Form::input('phone', $details['phone']); ?>
		
		<?=Form::label('showPhone', "Visa Telefonnummer?");?>
		<?=Form::checkbox('showPhone',1,(($details['showPhone'] == 1) ? true: false)); ?>
		
		<?=Form::label('adress', "Adress");?>
		<?=Form::input('adress', $details['adress']); ?>
		
		<?=Form::label('zipcode', "PostNr");?>
		<?=Form::input('zipcode', $details['zipcode']); ?>
		
		<?=Form::label('city', "Postort");?>
		<?=Form::input('city', $details['city']); ?>
		
		<?=Form::label('showPost', "Visa Postuppgifter?");?>
		<?=Form::checkbox('showPost', 1, ($details['showPost'] == 1 ? true: false)); ?>
		
		<?=Form::label('allergies', "Allergier");?>
		<?=Form::textarea('allergies', $details['allergies']); ?>
		
		<?=Form::label('showAllergies', "Visa Allergier?");?>
		<?=Form::checkbox('showAllergies', 1, ($details['showAllergies'] == 1 ? true: false)); ?>
		
		<?=Form::label('socialsecuritynumber', "Personnummer (10 siffror. Med bindestreck)");?>
		<?=Form::input('socialsecuritynumber', $details['socialsecuritynumber']); ?>

		<?=Form::label('email', "Epost");?>
		<?=Form::input('email', $details['email']); ?>
		
		<?=Form::label('showEmail', "Visa Epost?");?>
		<?=Form::checkbox('showEmail', 1, ($details['showEmail'] == 1 ? true: false)); ?>
		
		<?=Form::label('karworker', "Lag på STUK");?>
		<?=Form::input('karworker', $details['karworker']); ?>
		
		<?=Form::label('driverlicens', "Körkort");?>
		<?=Form::input('driverlicens', $details['driverlicens']); ?>
		
		<?=Form::label('programId', "Program");?>
		<?=Form::select('programId', user::get_programs(false, true), $details['programId']); ?>
		<?=Form::submit('submit', "Spara");?>
		</form>
</div>