<?php
class page_hidden extends Page {
    public $descr="Form's hidden is not going to appear visually but is still submitted and it's value can be changed too";
	function init(){
		parent::init();
		
		$form=$this->add('Form');
		$form->addField('hidden','a')->set(123);
        $form->addButton('Set to 5')
            ->js('click',$form->getElement('a')->js()->val(5));
		$form->addSubmit('submit hidden field');
		if($form->isSubmitted()){
			$form->js()->univ()->alert($form->get('a'))->execute();
		}
	}
}
