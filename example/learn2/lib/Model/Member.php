<?php
class Model_Member extends Model_Table {
	public $table="library_member";
	function init(){
		parent::init();
		
		$this->addField('name')->sortable(true);
		$this->addField('card_number')->sortable(true);

		// We can define theese only if we plan to reference them. While it makes sense to see curent 
		// member's borrowed book, there is no need to see all the preious borrowings, so i commented
		// that relation

		//$this->hasMany('Borrowing');
		$this->hasMany('BorrowingNow');
	}
}