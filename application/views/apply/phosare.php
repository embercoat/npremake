<?=Form::open('/apply/phosare/', array('method'=>'post')); ?>
<?=Form::label('whyphosa', 'Varför vill Du phösa?'); ?>
<?=Form::textarea('whyphosa','',array('rows' => 10, 'cols' => 50)); ?>
<?=Form::submit('submit', 'Ansök!'); ?>
<?=Form::close(); ?>