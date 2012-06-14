<?php
class page_jqgrid extends Page {
	public $descr='jqGrid is an amazing plugin for jQuery UI which implements an awesome implementation of JavaScript grid. This example demonstrates a re-usable widget compatible with Agile Toolkit Grid which can be used with static source, dynamic queries or models';
	function init(){
		parent::init();
		
		$this->add('View_Example','pagesource')->set("\n".'$page->add(\'jqgrid/jqGrid\')->setModel(\'Employee\');')
			->template->trySet('title','Source');


		$this->add('H2')->set('Add-on source');
		$this->add('View_Info')->set('The source of an add-on is educational, but you do not need them to get jqGrid working. It is all already included in jqgrid add-on distribution');
		$this->add('ViewSource','viewsource')->setFile($f='atk4-addons/jqgrid/lib/jqGrid.php')
			->template->trySet('title','Source of '.$f);

		$this->add('H2')->set('Controller Source');

		$this->add('ViewSource','controllersource')->setFile($f='atk4-addons/jqgrid/lib/Controller/jqGrid.php')
			->template->trySet('title','Source of '.$f);
	}
}

