<?php
class page_register extends Page {
	function init(){
		parent::init();
		
		$form = $this->add('Form');
        $form->addField('line','email');
        $form->addField('password','password');
        $form->addSubmit();
        $form->addButton('Cancel')->js('click')
        	->univ()->location($this->api->url('/'));

        if($form->isSubmitted()){
        	$form->js()->univ()->alert('Thank you, '.$form->get('email').
        		', but this example is not ready yet')->execute();

        }
	}
	function defaultTemplate(){
        return array('page/register');
    }
}