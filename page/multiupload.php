<?php
class page_multiupload extends Page {
    public $descr='Form field "upload" supports ability to add multiple files. They will be all stored in the filestore, but
        their IDs will be concatenated with comma and will be stored in the field';
	function init(){
		parent::init();
		$f=$this->add('Form');

		$this->add('View_Error')->set('Filestore syntax have been updated. It is now an add-on. New example coming soon.');
		return;

		$f->addField('upload','upload')->setController('Controller_Filestore_File')->allowMultiple(4);

		$f->addSubmit();
		if($f->isSubmitted()){
			$f->js()->univ()->alert($f->get('upload'))->execute();;
		}

	}
}

