<?php
class page_autocomplete extends Page {
    function init(){
        parent::init();

        $form=$this->add('Form');
        $name=$form->addField('autocomplete','name')->setModel('Employee');
        $form->getElement('name')->js('change',$form->js()->submit());

        $form2=$this->add('MVCForm');
        $model = $form2->setModel('Employee');
        if($_GET['id'])$model->loadData($_GET['id']);
        $form2->addSubmit();
        if($form2->isSubmitted()){
            $form2->update();
            $form2->js()->reload()->execute();
        }

        if($form->isSubmitted()){
            $form2->js()->reload(array('id'=>$form->get('name')))->execute();
        }
    }
}
class Model_Employee extends Model_Person {
	function defineFields(){
		parent::defineFields();

		$this->addField('name')
			->mandatory(true);

		$this->addField('days_worked')
			->system(true)
			->datatype('int');

		$this->addField('salary')
			->mandatory(true)
			->datatype('money');
	}
}
