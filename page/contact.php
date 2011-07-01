<?php
class page_contact extends Page {
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
