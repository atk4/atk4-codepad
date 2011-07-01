<?php
class page_hello extends Page {
	function init(){
		parent::init();
		$this->add('HelloWorld');
	}
}
