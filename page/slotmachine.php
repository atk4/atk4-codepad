<?php
class page_slotmachine extends Page {
    public $descr='As seen in "Learning Agile Toolkit" book, the SlotMachine.';
	function init(){
		parent::init();
		$this->add('View_SlotMachine');
	}
}
