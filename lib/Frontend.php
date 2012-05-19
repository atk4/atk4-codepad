<?php
class Frontend extends ApiFrontend {
	function init(){
		parent::init();
		$this->dbConnect();
		$this->addLocation('atk4-addons',array(
					'php'=>array(
                        'mvc',
						'misc/lib',
						)
					))
			->setParent($this->pathfinder->base_location);

		$this->add('jUI');

		$m=$this->add('View',null,'SubMenu',array('submenu'));
	}
    function page_back($p){
        $this->redirect('http://agiletoolkit.org/doc/');
    }
    function initLayout(){
        parent::initLayout();
        /*
        $toolbox=$this->add('Inspector');

        $toolbox->initButtons();

         */

    }
}
