<?php
class page_source extends Page {
	function subPageHandler($p){

		$t=$this->add('Text');
		try{
			$t->set(highlight_string(file_get_contents($this->api->locate('page',$p.'.php')),true));
		}catch(PathFinder_Exception $e){
			$t->destroy();
			$this->add('View_Error')->set('This file is not found');
		}
	}
}
