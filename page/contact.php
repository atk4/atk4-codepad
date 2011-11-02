<?php
class page_contact extends Page {
    public $descr='Low-level record adding to the database without use of Models or CRUDs. Sometimes, when you want to do
        things differently, you need to take a few steps back and rely on the basic components such as dsql() to do the job. ';
	function init(){
		parent::init();
		$form=$this->add('Form');
		$form->addField('line','name');
		$form->addField('line','email');
		$form->addField('text','notes');
		$form->addSubmit();
		if($form->isSubmitted()){
			$this->api->dbConnect();
			$this->api->db->dsql()
				->set($form->getAllData())
				->table('contact')
				->do_insert();
			$form->js()->univ()->alert('Thank you!')
				->location('/')->execute();
		}
	}
}
