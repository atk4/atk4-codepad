<?php
class page_hybrid extends Page {
    public $descr='Demonstration of Hybrid forms, which allow to encorporate different styles throughout the same form.';
	function init(){
		parent::init();
		$page=$this;

		$form=$page->add('Form',null,null,array('form_hybrid'));
		$form->setFormClass('vertical atk-form-vertical-2col');
		$form->addField('line','line1');
		$form->addField('line','line1a');
		$form->addSeparator('vertical atk-form-vertical-2col');
		$form->addField('line','line2');
		$form->addField('line','line2a');
		$form->addSeparator('vertical atk-form-vertical-3col');
		$form->addField('line','line3');
		$form->addSeparator('vertical atk-form-vertical-3col');
		$form->addField('line','line4');
		$form->addSeparator('vertical atk-form-vertical-3col');
		$form->addField('line','line5');

		$form->addSeparator('basic');
		$form->addField('text','line6');
		$form->addField('text','line7');
	}
}
