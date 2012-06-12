<?php
/**
 * Base class implementing book
 */
class Model_Book extends Model_Table {
	public $table="library_book";
	function init(){
		parent::init();
		
		$this->addField('name');
		$this->addField('issn')->sortable(true);

		// hasMany does not impact logic or performance of the model
		// so we can have multiple in here.
		$this->hasMany('Borrowing');
		$this->hasMany('Borrower');
	}
}