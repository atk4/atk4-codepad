<?php
class page_columns extends Page {
	function init(){
		parent::init();
		$page=$this;

		$options['col1']=array(
				array('value'=>'hell oworld'),
				array('value'=>'hell oworld'),
				array('value'=>'hell oworld'),
				);
		$options['col2']=array(
				array('value'=>'hell oworld'),
				array('value'=>'hell oworld'),
				array('value'=>'hell oworld'),
				);

	   	$form = $page->add('Form',null,null,array('form_empty'));
        $columns = $form->add('Columns');
        
        $grid1 = $columns->addColumn()->add('Grid');
        $grid2 = $columns->addColumn()->add('Grid');

        $grid1->setStaticSource($options['col1']);
        $grid2->setStaticSource($options['col2']);
        
        $grid1->addColumn('template','Menu')->setTemplate('<input type=\'radio\' name=\'selection\' value="<?$value?>"/> <?$value?>');
        $grid2->addColumn('template','Menu')->setTemplate('<input type=\'radio\' name=\'selection\' value="<?$value?>"/> <?$value?>');

		$salad_size = $form->addField('line','salad_size');

		$salad_field = $form->addField('line','salad');
		$salad_button = $salad_field->add('Button',null,'after_field')->setLabel('randomize');
		$salad_button->js('click')->univ()->ajaxec(
				array(
					$this->api->getDestinationURL(), 
					'generate_salad'=>true,
					'salad_size'=>$salad_size->js()->val(),
				));


		if($_GET['generate_salad']) $salad_field->js()->val( rand(10,$_GET['salad_size']) )->execute();


		$form=$this->add('Frame')->add('Form');
		$form->addField('line','salad_size');
		$form->addSubmit();
		if($form->isSubmitted()){
			$salad_field->js()->val( rand(10,$form->get('salad_size')))->execute();
		}

	}
}
