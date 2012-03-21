<?php
class page_jsonac extends Page {
    function init(){
        parent::init();
        $f=$this->add('Form');
        $f->addField('myfield','name')->setModel('Employee');
    }
}

