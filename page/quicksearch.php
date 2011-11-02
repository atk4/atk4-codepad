<?php
class page_quicksearch extends Page {
    public $descr='QuickSearch is based on a regular form, so you can still add fields to quicksearch and manipulate them as
        with regular form.';
	function init(){
		parent::init();
		// 
		$g=$this->add('MVCGrid');
		$g->setModel('Person');
		$s=$g->addQuickSearch(array('name'));
		$s->addField('dropdown','category');
	}
}
