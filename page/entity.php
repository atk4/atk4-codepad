<?php
class page_entity extends Page_EntityManager {
	public $controller='Controller_Person';
    function init(){
        $this->api->dbConnect();
        parent::init();
    }
	function initMainPage(){
		parent::initMainPage();

		$this->grid->addColumnPlain('link','./subpage','Click me');

	}
	function page_subpage(){
		$this->add('Text')->set('You have clicked on id='.(int)$_GET['id']);
	}
}
