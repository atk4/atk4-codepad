<?php
class page_editablef extends Page {
	function init(){
		$g = $this->add('Grid');
		$g->addColumn('inline','name');
		$g->addColumn('inline','email');
		$g->addColumn('expander','comments');
		$g->setSource('user');
	}
}
