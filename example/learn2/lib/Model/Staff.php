<?php
class Model_Staff extends Model_Table {
	public $table="library_staff";
	function init(){
		parent::init();

		$this->addField('name');

		// Reference for showing books issued by that member of staff. Consider this your practice excercise
		// to create a page which would show all the books which were issued by a certain member
		$this->hasMany('Borrowing');
	}
}