<?php
class page_metatags extends Page {
    public $descr='Regardless of where your code is, you can access template of the API to add some meta-data on your page.
        In this example we are adding a new meta tag into our main template.';
	function init(){

		parent::init();

		$this->api->template->append('js_include','<meta testing="123"/>');

		$this->add('View_Info')->set('View HTML source of this page, search for "123"');
	}
}
