<?php
class Frontend extends ApiFrontend {
    public $example_cut;
    public $tree;
    
	function init(){
		parent::init();
		$this->dbConnect();

        $this->pathfinder->addLocation('./',array(
            'docs'=>'docs',
            'addons'=>array('atk4-addons','addons','ds-addons'),
            'php'=>array('atk4-addons/mvc','atk4-addons/misc/lib'),
//            'template'=>'atk4-addons/misc/templates',
//            'js'=>array('js','templates/js'),
        ));
		$this->add('jUI');



        $this->md_pages = array(
            'scaffolding',
            'simple_views',
            'navigation',
            'interactive-views',
            'combined-example',
            'your-snippets',
        );

        $this->real_page = $this->page;
        $r = $this->add("Controller_PatternRouter");
        foreach ($this->md_pages as $page) {
            $r->addRule($page, 'mdpage', array('args'));
            $r->addRule($page.'\/(.*)', 'mdpage', array('args'));
        }
        $r->route();


        // TODO We will need this after removing initLayout() method
        // It shows menu on the left-hand side
//        if(!$this->tree && $this->template->hasTag('SubMenu')){
//            $tree=$this->add('TreeView',null,'SubMenu',array('submenu'));
//            $tree->setModel('Menu');
//        }

	}
    function page_back($p){
        $this->redirect('http://agiletoolkit.org/doc/');
    }


    /*
     * TODO !!!
     * Remove this method when we will use only md files for examples
     * we need this just to see old examples
     */
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

        if (!$this->api->code_executed) {
            $page->template->eachTag('Code',function($a,$b) use($page){ $page->add('View_Code',null,$b)->set($a); });
            $page->template->eachTag('Example',function($a,$b) use($page){ $page->add('documenting/View_Example',null,$b)->set($a); });
            $page->template->eachTag('Silent',function($a,$b) use($page){ $page->add('documenting/View_Example',null,$b)->set($a,true); });
            $page->template->eachTag('ExecuteTrigger',function($a,$b) use($page){ $page->add('documenting/View_ExecuteTrigger',null,$b)->set($a,'trigger'); });
        }


        if(!$this->tree && $this->template->hasTag('SubMenu')){
            $tree=$this->add('TreeView',null,'SubMenu',array('submenu'));
            $tree->setModel('Menu');
        }
    }
    public $code_executed = false;
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
