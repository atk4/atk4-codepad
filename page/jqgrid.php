<?php
class page_jqgrid extends Page {
	public $descr='jqGrid is an amazing plugin for jQuery UI which implements an awesome implementation of JavaScript grid. This example demonstrates a re-usable widget compatible with Agile Toolkit Grid which can be used with static source, dynamic queries or models';
	function init(){
		parent::init();
		

		$this->add('H2')->set('jqGrid with static source');
		$g=$this->add('jqgrid/jqGrid');//->setModel('Employee');

		$g->addColumn('text','hello',array('width'=>300));
		$g->addColumn('text','col2');

		$g->setSource(
			array(
				array('hello'=>'world','col2'=>'test'),
				array('hello'=>'of','col2'=>'<b>abc'),
				array('hello'=>'Grid','col2'=>'ok'),
				)
			);

		$this->add('H2')->set('jqGrid with Model');

		$g=$this->add('jqgrid/jqGrid')->setModel('Employee');


		$this->add('H2')->set('View Source');

		$this->add('ViewSource','viewsource')->setFile($f='atk4-addons/jqgrid/lib/jqGrid.php')
			->template->trySet('title','Source of '.$f);

		$this->add('H2')->set('Controller Source');

		$this->add('ViewSource','controllersource')->setFile($f='atk4-addons/jqgrid/lib/Controller/jqGrid.php')
			->template->trySet('title','Source of '.$f);
	}
}

