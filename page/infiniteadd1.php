<?php
class page_infiniteadd1 extends Page {
	function init(){
		parent::init();

		$this->add('InfiniteAddForm')->setModel('Employee');
	}
}
class InfiniteAddForm extends View {
    function setController($c){
        $this->c=$c;
        $this->addForm($_GET[$this->name]?$_GET[$this->name]:1);
    }
    function addForm($seq){
		$this->api->stickyGET($this->name);
        $this->form=$f=$this->add('MVCForm',$seq,null,array('form_horizontal'));
        $f->setController($this->c);
		$next_form=$this->name.'_'.($seq+1);


		$first_field=null;
		foreach($f->elements as $element){
			if(!($element instanceof Form_Field))continue;
			$element->js(true)->univ()->disableEnter();
			if(!$first_field)$first_field=$element;
			$last_field=$element;
		}
		$first_field->setAttr('class','nofocus');

		$first_field->js('focus',array(
			$this->js()->append('<div id="'.$next_form.'"/>'),
			$this->js()->_selector('#'.$next_form)->atk4_load($this->api->getDestinationURL(null,
					array($this->name=>$seq+1,'cut_object'=>$next_form))),
			$first_field->js()->unbind('focus'),
		));

		$last_field->js('blur',$f->js()->submit());
		if($f->isSubmitted()){            
			$id=$f->update();            
			$f->js()->remove()->univ()->successMessage('Saved record #'.$id)->execute();        
		}

    }

}
class Model_Person extends Model_Table {
	public $entity_code='person';
	public $table_alias='p';
	function defineFields(){
		parent::defineFields();

		$this->addField('name');
	}
}
// Copied from Agile Toolkit Website
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

		$this->addField('money_owed')
            ->caption('Owed')
			->calculated(true);
	}
	function gotoWork(){
		$this->set('days_worked',
			$this->get('days_worked')+1);
		return $this;
	}
	function paySalary(){
		$c= $this->add('Model_Salary')
			->set('amount',
				$this->get('money_owed'))
			->set('employee_id',
				$this->get('id'))
			;
		$c->update();
		$this->set('days_worked',0)
			->update();
		return $c;
	}
	function calculate_money_owed(){
		return 'days_worked * salary';
	}
}
