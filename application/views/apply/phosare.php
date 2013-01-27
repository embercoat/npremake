<?php
if(count($application) == 0){
 echo Form::open('/apply/phosare/', array('method'=>'post'))

     .Form::label('whyphosa', 'Varför vill Du phösa?')
     .Form::textarea('whyphosa','',array('rows' => 10, 'cols' => 50))

     .Form::label('programId', "Jag vill phösa")
     .Form::select('programId', array_merge(array(0 => 'Spelar ingen roll'), user::get_programs(false, true)))

     .Form::label('cph', "Jag vill vara CPh")
     .Form::checkbox('cph', 1)

     .Form::submit('submit', 'Ansök!')
     .Form::close();
} else { ?>
    <p>Du har redan ansökt om att bli phösare i år. Ta kontakt med NPG om du vill ändra din ansökan</p>
<?php } ?>