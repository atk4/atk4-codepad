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

        $this->add('TreeView',null,'SubMenu',array('submenu'))
            ->setModel('Menu');
	}
    function page_back($p){
        $this->redirect('http://agiletoolkit.org/doc/');
    }
    function initLayout(){
        parent::initLayout();
        $page=$this->page_object;
        $page->template->eachTag('Example',function($a,$b) use($page){ $page->add('View_Example',null,$b)->set($a); });

        /*
        $toolbox=$this->add('Inspector');

        $toolbox->initButtons();

         */

    }
}
