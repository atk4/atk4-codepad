<?php
class page_reloadformac extends Page {
    public $skip=true;
	function init(){
		parent::init();

		$form1=$this->add('Form');
		$selection=$form1->addField('autocomplete','user')->setController('Controller_User');

		$form2=$this->add('MVCForm');

		$selection->js('change',$form2->js()->reload(array('user_id'=>$selection->js()->val())));

		$this->api->stickyGET('user_id');

		$form2->setController('Controller_User');
		if($_GET['user_id'])$form2->getController()->loadData($_GET['user_id']);

		if($form2->isSubmitted()){
			$form2->update();
			$form2->js()->univ()->alert('Saved successfully')->execute();
		}
	}
}
