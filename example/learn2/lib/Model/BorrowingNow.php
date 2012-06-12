<?php
/**
 * Anohter handy model which shows only current borrowings
 */
class Model_BorrowingNow extends Model_Borrowing {
	function init(){
		parent::init();
		
		$this->addCondition('is_returned',false);
	}
}