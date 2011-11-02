<?php
class page_newsletter extends Page {
	function page_index(){
		$this->add('H1')->set('Step 1');
		$form=$this->add('Form');
		$form->addField('line','name');
		$form->addField('line','surname');
		$form->addSubmit();
		if($form->isSubmitted()){
			$this->api->memorize('newsletterform',$form->getAllData());
			$this->js()->atk4_load($this->api->getDestinationURL('./step2'))->execute();
		}
	}
	function page_step2(){
		$this->add('H1')->set('Step 2');
		$form=$this->add('Form');
		$form->addField('line','email');
		$form->addSubmit();
		if($form->isSubmitted()){
			$data=array_merge($this->api->recall('newsletterform'),$form->getAllData());
			$this->api->forget('newsletterform');
			$this->js()->univ()->successMessage('data is: '.json_encode($data))->execute();
		}
	}
}
