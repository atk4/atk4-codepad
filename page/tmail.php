<?php
class page_tmail extends Page {
    public $skip=true;
	function init(){
		parent::init();

		$this->add('View_Hint')->set('This demo shows how to use TMail class. It does not actually send semail. See source
				for more information');

		$mail=$this->add('TMail');
		$mail->loadTemplate('test-mail');
		//$mail->set('subject','Custom Subject');
		$mail->setTag('name','John');
		$mail->setTag('product','VAC-293');
		$mail->setTag('link',$this->api->getDestinationURL('./register',array('code'=>'123'))
				->useAbsoluteURL());

		//$mail->send($this->api->getConfig('mail/test-tmail','nobody@nowhere.com'));

		// NOTE: You do not need to copy remaining lines. They are only to demonstrate
		// how TMail::send function works!

		if(!$mail->get('from'))$mail->set('from',$this->api->getConfig('mail/from','nobody@nowhere.com'));
		$this->add('HtmlElement')
			->setElement('H1')
			->set('Headers');
		$pre=$this->add('HtmlElement')->setElement('pre');

		$pre->add('Text')->set('Subject: '.$mail->get('subject',false)."\n");
		$pre->add('Text')->set($mail->getHeaders());

		$this->add('HtmlElement')
			->setElement('H1')
			->set('Body');
		$this->add('HtmlElement')
			->setElement('pre')
			->set($mail->getBody());

	}
}

/*

  From is defined in the config file:

$config['mail']['from']='codepad@agiletoolkit.org';

   Contents of templates/mail/test-mail.txt

<?headers?>
<?/headers?>
<?subject?>Product Purchase Confirmation<?/?>
<?body?>

Hi <?$name?>

Thank you for purchasing <?$product?>. 

To receive support you should register by clicking on the following link:
<?$link?>

<?$sign?>
<?/body?>
*/
