<?php
class page_jsonac extends Page {
	public $descr='Start typing employee name and a custom-build autocomplete field will help you finish it';
    function init(){
        parent::init();
        $f=$this->add('Form');
        $f->addField('myfield','name')->setModel('Employee');

        $this->add('ViewSource')->setFile($f='lib/Form/Field/myfield.php')
        	->template->trySet('title','Source of '.$f);

    }
}

