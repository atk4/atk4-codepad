<?php
class page_old_issue12 extends Page {
    public $descr='Initially test-case for <a href="https://github.com/atk4/atk4/issues/12">issue #12</a> this example
        demonstrate use of QuickSearch for grid';
	function init(){
		parent::init();


		$g=$this->add('MVCGrid')->setModel('Employee');

		$g=$this->add('MVCGrid');
		$g->setModel('Employee');
		$g->addQuickSearch(array('name','salary'));
        $g->template->trySetHTML('grid_buttons','&nbsp;');

	}
}
