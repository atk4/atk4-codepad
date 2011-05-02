<?php
class page_50employees2 extends Page {
	function init(){
		parent::init();

		$this->js()->_load('ui.atk4_notify');
		$this->api->versionRequirement('4.0.99');

		$f=$this->add('Form');
		for($i=0;$i<5;$i++){
			$r=$f->addField('autocomplete','n'.$i,'Employee');
			$r->setModel('Employee');
			$r->includeDictionary(array('salary'));
			$s=$f->addField('line','s'.$i,'Set Salary');
			$r->js(true)->univ()->bindFillInFields(array('salary'=>$s));
		}
		$f->addSubmit();

		$m=$this->add('Model_Employee');
		if($f->isSubmitted()){
			for($i=0;$i<5;$i++){
				$emp=$f->get('n'.$i);
				if($emp)$m->loadData($emp)->set('salary',$f->get('s'.$i))->update();
			}
			$f->js()->univ()->successMessage('Updated')
				->execute();
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
