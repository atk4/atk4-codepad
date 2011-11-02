<?php
class page_infiniteadd1 extends Page {
    public $descr='Entering data continiously using only the keyboard. This have been challenge for many web developers. Data
        also needs to be properly saved and additional fields needs to become available as needed. Try entering name, using
        tab key to go into salary, entering salary, then using tab key to move further.';

	function init(){
		parent::init();
		$this->add('InfiniteAddForm')->setModel('Employee');
	}
}
