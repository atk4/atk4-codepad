<?php
class page_issue12 extends Page {
	function init(){
		parent::init();


		$g=$this->add('MVCGrid')->setController('Controller_User');

		$g=$this->add('MVCGrid');
		$g->setController('Controller_User');
		$g->addQuickSearch(array('email'));
	}
}
