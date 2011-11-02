<?php
class page_hello extends Page {
    public $descr='"Hello World" in Agile Toolkit. That\'s as simple as adding a HelloWorld object. So to give you a bonus,
           we have added a Text object which can be used with any text message.';
	function init(){
		parent::init();
		$this->add('HelloWorld');

        $this->add('Text')->set('Hello World Again');
	}
}
