<?php
/**
 * A dedicated model for books which are available to borrow
 */
class Model_BookAvailable extends Model_Book {
	function init(){
		parent::init();
		
		// We must select books which are either never been borrowed or have been returned
		$f=$this->join('library_borrowing.library_book_id',null,'left')->addField('is_returned')->system(true);

		// Now that our relation is defined we can add custom condition with the OR clause.
		$this->addCondition($this->dsql()->orExpr()->where($f,'is',null)->where($f,'1'));
	}
}