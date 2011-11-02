<?php
class page_issue12 extends Page {
    public $descr='Initially test-case for <a href="https://github.com/atk4/atk4/issues/12">issue #12</a> this example
        demonstrate use of QuickSearch for grid';
	function init(){
		parent::init();


		$g=$this->add('MVCGrid')->setModel('User');

		$g=$this->add('MVCGrid');
		$g->setModel('User');
		$g->addQuickSearch(array('email'));
	}
}
