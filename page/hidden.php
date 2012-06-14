<?php
class page_hidden extends Page {
	function init(){
		parent::init();
		
		$form=$this->add('Form');
		$form->addField('hidden','a')->set(123);
		$form->addSubmit('submit hidden field');
		if($form->isSubmitted()){
			$form->js()->univ()->alert($form->get('a'))->execute();
		}
	}
}