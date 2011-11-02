<?php
class page_slider extends Page {
	function init(){
		parent::init();
		$form = $this->add('Form');
		$element = $form->add('HtmlElement');
		$slider = $form->addField('Slider','sl');

		$s='#'.$slider->name.'_slider';
		$this->js(true)->_selector($s)->bind('slide',$element->js()->_enclose()->html(
					$this->js()->_selector($s)->slider('value')
					));
	}
}
