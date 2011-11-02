<?php
class page_quicksearch extends Page {
	function init(){
		parent::init();
		// 
		$g=$this->add('MVCGrid');
		$g->setModel('Person');
		$s=$g->addQuickSearch(array('name'));
		$s->addField('line','name');
	}
}
