<?php
class page_layoutswitch extends Page {
    public $descr='Changing template of an object based on conditions. Function defaultTemplate() is called before init() but
        you can put some code in there if you want to switch between templates conditionally. Additionally in this example I
        have added a cool effect when the page is being re-loaded';
	function init(){
		parent::init();
		$this->js(true)->show('slide');
		if($this->add('Button',null,'LayoutSwitch')->setLabel('Reset')->isClicked()){
			$this->forget('layout');
			$this->js()->reload()
				->execute();
		}

		$button=$this->add('Button',null,'LayoutSwitch')
			->setLabel('Switch Layout');
		$button->js('click',$this->js()->fadeOut());
		if($button->isClicked()){
			$this->memorize('layout', 
					3-$this->recall('layout',1));

			$this->js()->reload()->execute();
		}

		$this->add('LoremIpsum');
	}


	function defaultTemplate(){
		switch($this->recall('layout',1)){
			case 1:
				return array('page/layoutswitch1');
			case 2:
			default:
				return array('page/layoutswitch2');

		}
	}
}
