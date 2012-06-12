<?php
class page_history extends Page {
	function init(){
		parent::init();
		
		// Simply display contents of a model with pagination
		$grid=$this->add('Grid');
		$grid->setModel('Borrower');
		$grid->addPaginator();
	}
}