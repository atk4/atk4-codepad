<?php
class page_image extends Page {
	function init(){
		parent::init();
		$this->api->versionRequirement('4.1b1');
		$f=$this->add('Form');

		$f->addField('upload','upload')->setController('Controller_Filestore_Image');

		$this->add('MyGrid')->setModel('Filestore_Image');
		$this->add('MyGrid')->setModel('Filestore_File');

		$f->addSubmit();
		if($f->isSubmitted()){
			$f->js(null,$this->js()->reload())->univ()->successMessage('Image uploaded')->execute();;
		}


	}
}
class MyGrid extends MVCGrid {
	function setModel($m){
		parent::setModel($m);
		$this->dq->order('id desc')->limit(10);
	}
}
