<?php
/**
 * Showing list of books
 */
class page_books extends Page {
	function init(){
		parent::init();
		
		// Will show 2 tabs on a page, one for all books, other for books available to borrow
		$tt=$this->add('Tabs');

		$cr=$tt->addTab('All')->add('CRUD');
		$cr->setModel('Book');
		if($cr->grid)$cr->grid->addQuickSearch(array('name','issn'));

		$cr=$tt->addTab('Available to Borrow')->add('CRUD');
		$cr->setModel('BookAvailable');
		if($cr->grid)$cr->grid->addQuickSearch(array('name','issn'));

		// We also include quicksearch for easier search
	}
}