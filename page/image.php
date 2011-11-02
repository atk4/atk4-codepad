<?php
class page_image extends Page {
    public $descr='Uploading images, storing them safely, creating thumbnail. This used to be a lot of work but not with
        Agile Toolkit. Filestore_Image model extends on the "File" by automatically generating thumbnails when needed.
        You can see that each file you upload creates two files in filestore.';
	function init(){
		parent::init();
		$f=$this->add('Form');

		$f->addField('upload','upload')->setModel('Filestore_Image');

		$this->add('FileGrid')->setModel('Filestore_Image');
		$this->add('FileGrid')->setModel('Filestore_File');

		$f->addSubmit();
		if($f->isSubmitted()){
			$f->js(null,$this->js()->reload())->univ()->successMessage('Image uploaded')->execute();;
		}
	}
}
