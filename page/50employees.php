<?php
class page_50employees extends Page {
    public $descr='The other day I got asked: "I have lots of employees to enter. What\'s the fastest name to enter them?".
        We can certainly build a form with lots of fields and the make it produce many records when it\'s submitted.';
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


