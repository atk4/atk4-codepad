<?php
class page_50employees extends Page {
	function init(){
		parent::init();

		$f=$this->add('Form');
		for($i=0;$i<50;$i++){
			$f->addField('line','e'.$i,'Name');
		}
		$f->addSubmit();

		$m=$this->add('Model_Employee');
		if($f->isSubmitted()){
			$cnt=0;
			for($i=0;$i<50;$i++){
				$emp=$f->get('e'.$i);
				if($emp){
					$cnt++;
					$m->unloadData()
						->set('name',$emp)
						->update();
				}
			}
			$f->js()->univ()->alert($cnt.' employees added')
				->execute();
		}

	}
}

class Controller_Employee extends Controller {
	public $model_name='Model_Employee';
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
