<?php
class page_50employees2 extends Page {
    public $descr='After I created <a href="/50employees">50employees example</a> next I was asked what if we want to change
        salaries of the employees who already in the database? This example demonstrates use of autocomplete fields and also
        how you can add dictionary for a reference field. This allows you to automatically fill other fields when value is
        selected';
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
