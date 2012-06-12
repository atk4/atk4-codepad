<?php
class page_staff extends Page {
	function init(){
		parent::init();
		
		// The most trivial usage of CRUD
		$this->add('CRUD')->setModel('Staff');
	}
}