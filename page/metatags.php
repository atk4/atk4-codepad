<?php

class page_metatags extends Page {
	function init(){
		parent::init();

		// Move this code in $api if you want it to appear on all pages
		$this->api->add('Text',null,'js_include')
			->set('<meta testing="123"/>');

		$this->add('View_Info')->set('View HTML source of this page');
	}
}
