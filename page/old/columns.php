<?php
class page_old_columns extends Page {
    public $descr='Design of complex forms with a non-standard layout often can be done with existing components of Agile
        Toolkit. In the form below you will see a lot of techniques in action to perform AJAX reuests, insert non-standard
        fields into the form and interraction between multiple forms';
	function init(){
		parent::init();
		$page=$this;

		$this->add('H2')->set('On-Line Sandwitch');

		// Define contents of our grids. They don't have to be sourced from DB
		$options['col1']=array(
				array('value'=>'Cheese'),
				array('value'=>'Chicken'),
				array('value'=>'Letuce <:'),	// we are HTML-safe
				);
		$options['col2']=array(
				array('value'=>'Egg'),
				array('value'=>'Bacon'),
				array('value'=>'Grilled Ol\'Japaleno'),
				);

		// using a different form template to lay out fields horizontally. Remember that you can always
		// create your own template for a form
	   	$form = $page->add('Form',null,null,array('form_horizontal'));

	   	// Agile Toolkit allows us to insert anything into anothyng. Why not add columns and grid into form
        $columns = $form->add('Columns');
        $grid1 = $columns->addColumn(6)->add('Grid');
        $grid2 = $columns->addColumn(6)->add('Grid');

        $grid1->setStaticSource($options['col1']);
        $grid2->setStaticSource($options['col2']);
        
        // Column of type TEMPLATE allows us to set a custom HTML to be used inside a column
        // It will also have values inserted right in
        $grid1->addColumn('template','Topping')
        	->setTemplate('<input type=\'radio\' name=\'selection\' value="<?$value?>"/> <?$value?>');
        $grid2->addColumn('template','Topping')
        	->setTemplate('<input type=\'radio\' name=\'selection\' value="<?$value?>"/> <?$value?>');

		$salad_size = $form->addField('line','salad_size','Max Salad Size')->set(30);
		$salad_field = $form->addField('line','salad');

		// addButton is a new method in ATK4.2 which allows to append or pre-pend button to your input
		// field.
		$salad_button = $salad_field->addButton('after')->setLabel('randomize');
		if($salad_button->isClicked()){
			$salad_field->js()->val( rand(10,$_GET['salad_size']) )->execute();

		}
		$salad_field = $form->addField('checkbox','heat','Reheat your sandwitch');

        $form->addSubmit('Place Order');
        if($form->isSubmitted())
            $form->js()->univ()->alert('Ordered '.$_POST['selection'].' of size '.$form->get('salad').
            	($form->get('heat')?'. Reheated':'')
            	)->execute();
	}
}
