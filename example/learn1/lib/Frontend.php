<?php
class Frontend extends ApiFrontend {
	function init(){
		parent::init();

		$this->add('jUI');

		$menu=$this->add('Menu',null,'Menu');
		$menu->addMenuItem('register');
		
	}
}