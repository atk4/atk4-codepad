<?php
class page_columns extends Page {
    public $descr='Design of complex forms with a non-standard layout often can be done with existing components of Agile
        Toolkit. In the form below you will see a lot of techniques in action to perform AJAX reuests, insert non-standard
        fields into the form and interraction between multiple forms';
	function init(){
		parent::init();
		$page=$this;

		$options['col1']=array(
				array('value'=>'Cheese'),
				array('value'=>'Chicken'),
				array('value'=>'Letuce <:'),
				);
		$options['col2']=array(
				array('value'=>'Egg'),
				array('value'=>'Bacon'),
				array('value'=>'Grilled Ol\'Japaleno'),
				);

	   	$form = $page->add('Form',null,null,array('form_empty'));
        $form->setFormClass('horizontal');
        $columns = $form->add('Columns');
        
        $grid1 = $columns->addColumn()->add('Grid');
        $grid2 = $columns->addColumn()->add('Grid');

        $grid1->setStaticSource($options['col1']);
        $grid2->setStaticSource($options['col2']);
        
        $grid1->addColumn('template','Topping')->setTemplate('<input type=\'radio\' name=\'selection\' value="<?$value?>"/> <?$value?>');
        $grid2->addColumn('template','Topping')->setTemplate('<input type=\'radio\' name=\'selection\' value="<?$value?>"/> <?$value?>');

		$salad_size = $form->addField('line','salad_size','Max Salad Size')->set(30);

		$salad_field = $form->addField('line','salad');
		$salad_button = $salad_field->add('Button',null,'after_field')->setLabel('randomize');
		$salad_button->js('click')->univ()->ajaxec(
				array(
					$this->api->getDestinationURL(), 
					'generate_salad'=>true,
					'salad_size'=>$salad_size->js()->val(),
				));


		if($_GET['generate_salad']) $salad_field->js()->val( rand(10,$_GET['salad_size']) )->execute();
        $form->addSubmit('Order');
        if($form->isSubmitted())
            $form->js()->univ()->alert('Ordered '.$_POST['selection'].' of size '.$form->get('salad'))->execute();;


		$form=$this->add('Frame')->setTitle('XL Salads')->add('Form');
		$form->addField('line','salad_size','Max Salad Size')->set(50);
		$form->addSubmit();
		if($form->isSubmitted()){
			$salad_field->js()->val( rand(10,$form->get('salad_size')))->execute();
		}

	}
}
