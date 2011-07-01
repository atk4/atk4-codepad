<?php
class page_multiupload extends Page {
	function init(){
		parent::init();
		$f=$this->add('Form');

		$f->addField('upload','upload')->setController('Controller_Filestore_File')->allowMultiple(4);

		$f->addSubmit();
		if($f->isSubmitted()){
			$f->js()->univ()->alert($f->get('upload'))->execute();;
		}

	}
}

