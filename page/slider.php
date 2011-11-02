<?php
class page_slider extends Page {
    public $descr='Adding slide action to a slider which would update other element on your page. This might have been easier
        done in plain JavaScript but you can still do it using jQuery Chain';
	function init(){
		parent::init();
		$form = $this->add('Form');
		$element = $form->add('HtmlElement');
		$slider = $form->addField('Slider','sl','Slide Me');

		$s='#'.$slider->name.'_slider';
		$this->js(true)->_selector($s)->bind('slide',$element->js()->_enclose()->html(
					$this->js()->_selector($s)->slider('value')
					));
	}
}
