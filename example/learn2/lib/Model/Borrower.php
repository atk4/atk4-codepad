<?php
/**
 * Models can be defined in either way and can be based on as many tables as you wish. Borrower shows
 * members which currently have got some books
 */
class Model_Borrower extends Model_Member {
	public $b;
	function init(){
		parent::init();
		
		$this->b=$this->join('library_borrowing.library_member_id');

		$this->b->hasOne('Staff','verified_by');
		$this->b->addField('borrowed');
		$this->b->addField('is_returned');
		$this->b->addField('returned');

		$this->b->join('library_book')->addField('book_name','name');

		// Showing only if borrowed
		//$this->addCondition('is_returned',false);

		// We don't want anyone to accidentally insert into this model as it will impact both 
		// joined tables, so we create validation to avoid that.
		$this->addHook('beforeInsert',function($m){ throw $m->exception('Do not add borrower directly');});
	}
}