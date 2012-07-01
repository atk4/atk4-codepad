<?php
class Model_Borrowing extends Model_Table {
	public $table="library_borrowing";
	function init(){
		parent::init();
		
		$this->hasOne('Book');
		$this->hasOne('Member');
		$this->hasOne('Staff','verified_by')->sortable(true);

		$this->addField('borrowed')->type('date')->defaultValue(date('Y-m-d'));

		$this->addField('is_returned')->type('boolean')->defaultValue(false);
		$this->addField('returned')->type('date');
	}
	function returnBook(){
		if($this['is_returned'])throw $this->exception('Book was already returned');
		$this['is_returned']=true;
		$this['returned']=date('Y-m-d');
		return $this->save();
	}
}