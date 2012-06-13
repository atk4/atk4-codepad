<?php
class Frontend extends ApiFrontend {
    public $example_cut;
    public $tree;
    
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

	}
    function page_back($p){
        $this->redirect('http://agiletoolkit.org/doc/');
    }
    function initLayout(){
        try {
            parent::initLayout();
        }catch(Exception_StopInit $e){}
        $page=$this->page_object;

        if(@$page->descr){
            $page->add('Order')->move(
                $page->add('View_Info')->setHTML($page->descr)
                ,'first')->move(
                $page->add('Button')->set('View Source')->js('click')
                    ->univ()->location('https://github.com/atk4/atk4-codepad/blob/master/page/'.
                    $this->api->page.'.php')->owner
                ,'first')->now();


        }

        $page->template->eachTag('Example',function($a,$b) use($page){ $page->add('View_Example',null,$b)->set($a); });
        $page->template->eachTag('Silent',function($a,$b) use($page){ $page->add('View_Example',null,$b)->set($a,true); });
        $page->template->eachTag('ExecuteTrigger',function($a,$b) use($page){ $page->add('View_ExecuteTrigger',null,$b)->set($a,'trigger'); });


        if(!$this->tree && $this->template->hasTag('SubMenu')){
            $tree=$this->add('TreeView',null,'SubMenu',array('submenu'));
            $tree->setModel('Menu');
        }
    }
    function render(){
        $this->js(true)->_load('myuniv')->univ()->softScroll();
        $this->js(true,'if(window.cb)window.cb($(document).height())');
        if(!$this->api->example_cut)return parent::render();

        $this->template->setHTML('Content',$this->example_cut->template->render());
        parent::render();
        /*
        $toolbox=$this->add('Inspector');

        $toolbox->initButtons();

         */

    }
    function defaultTemplate(){
        if($_GET['cut'])return array('empty');else return array('shared');
    }

}
