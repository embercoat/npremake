<?php
    if($justApplied) {?>
    <p>Du har redan ansökt om att bli phösare i år.</p>

<?php
}

if($all_good){
    if((count($application) == 1 && $application[0]['approved'] == 0) or count($application) == 0) {
    echo Form::open('/apply/phosare/', array('method'=>'post'))
        .Form::hidden('applicationid', ((count($application)) ? $application['0']['id'] : 'new'))

        .Form::label('whyphosa', 'Berätta kort om dig själv och varför du vill phösa. OBS! Detta kan bli utslagsfråga.')
        
	.Form::textarea('whyphosa', ((count($application)) ? $application['0']['whyphosa'] : ''),array('rows' => 10, 'cols' => 50))

        
	.Form::label('phosbuddy', 'Vilka vill du Phösa med?')
        
	.Form::textarea('phosbuddy', ((count($application)) ? $application['0']['phosbuddy'] : ''),array('rows' => 10, 'cols' => 50))
	
	.Form::label('klass', 'Jag studerar')
	.Form::textarea('klass', ((count($application)) ? $application['0']['klass'] : ''),array('rows' => 1, 'cols' => 50))
	
	.Form::label('studentikosa', 'Studentikåsa engagemang. T.ex. Föreningar, sektioner.')
	.Form::textarea('studentikosa', ((count($application)) ? $application['0']['studentikosa'] : ''),array('rows' => 1, 'cols' => 50))
	
	.Form::label('phosHistoryBox', "Har du phöst tidigare?")
    .Form::checkbox('phosHistoryBox', 1, ((count($application)) ? $application['0']['phosHistoryBox'] : 0))
	
	.Form::label('phosHistory', 'Om ja, vilka årtal?')   
	.Form::textarea('phosHistory', ((count($application)) ? $application['0']['klass'] : ''),array('rows' => 1, 'cols' => 50))


	.Form::label('program', "Jag vill phösa")
        .Form::select('program', array_merge(array(0 => 'Spelar ingen roll'), user::get_programs(false, true)), ((count($application)) ? $application['0']['program'] : ''))
		
		.Form::label('union', "Kårmedlem?")
		.Form::checkbox('union', 1, ((count($application)) ? $application['0']['union'] : 0))

        .Form::label('cph', "Jag vill vara CPh")
        .Form::checkbox('cph', 1, ((count($application)) ? $application['0']['cph'] : 0))
		
		.Form::label('importantMe', "Är Phösargrupp viktigare än nolleklass. OBS ej kuggfråga")
        .Form::checkbox('importantMe', 1, ((count($application)) ? $application['0']['importantMe'] : 0))
		
		

        .Form::submit('submit', 'Ansök!')
        .Form::close();
    } else {
	echo 'Din anmälan har redan blivit godkänd. Du kan inte längre ändra den.';
    }
} else {
    echo 'Du saknar en del viktig information på din profil. Vänligen gå till <a href="/me/editDetails" style="text-decoration: underline">personuppgifter</a> och fyll i.';
}
