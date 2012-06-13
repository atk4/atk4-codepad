<?php
class View_RepairBox extends View_Info {
	function init(){
		parent::init();
		$this->set('This example is currently being under reconstruction for the 4.2 version of Agile Toolkit');

		throw $this->exception('','StopInit');
	}
}