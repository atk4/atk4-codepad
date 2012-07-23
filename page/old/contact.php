<?php
class page_old_contact extends Page {
    public $descr='How hard should it be to create a contact form? With Agile Toolkit it\'s super easy. Here is your only step to creating it.';
	function init(){
		parent::init();
		$form=$this->add('Form');
		$form->addField('line','name')->validateNotNull();
		$form->addField('line','email')->validateNotNull();
		$form->addField('line','phone');
		$form->addField('text','notes');
		$form->addSubmit();
		if($form->isSubmitted()){

			// Perform validation here
			if(!filter_var($form->get('email'), FILTER_VALIDATE_EMAIL)){
                $form->displayError('email','Incorrect email');
            }

			// Use TMail object for sending out email
			$m=$this->add('TMail');
            $m->setTemplate('contact');

            // The following line will output contents of email on screen instead of actually sending it
            $m->addTransport('echo');

            // All fields from a form go into template
            $m->set($form->get());

            $m->set('subject','Contact Request from'.$form->get('name'));
            $x=$m->send('you@example.com',$form->get('email'));
            $this->js()->univ()->successMessage('Your message was delivered')->execute();

		}

		$this->add('H3')->set('Mail Template');
		// Include source for template
		$this->add('ViewSource')->setFile('templates/mail/contact.mail')
			->template->trySet('title','Source of templates/mail/contact.mail');
	}

}
