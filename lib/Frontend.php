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

        /*
		$m=$this->add('Menu',null,'Menu');
		$m->addMenuItem('Index','index');
		$m->addMenuItem('Back to Agile Toolkit','back');
         */
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
