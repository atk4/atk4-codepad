<?php
class page_mypage extends Page {
  function init(){
	parent::init();
	$page=$this;
	
	$u = $_GET[$this->name] ? $_GET[$this->name]: 1;
	
	// This argument is passed when 2nd, 3rd etc forms are loaded. We should preserve it to submit proprely
	$this->api->stickyGET($this->name);

	// Horizontal form is good for 4 fields. Most of the behaviour can be changed through Controller
	
	$name = $_GET[$this->name] ? $this->name . "_" . $_GET[$this->name] : $this->name . "_" . 1;	
	$form = $this->add('Form',$name);
	
	$f = $form->addField("line", "field1", "field1");
	$f = $form->addField("line", "field2", "field2");
	$form->addSubmit();
	
	$first_field=null;
	foreach($form->elements as $element){
	  if(!($element instanceof Form_Field))continue;
	  $element->js(true)->univ()->disableEnter();
	  if(!$first_field)$first_field = $element;
	  $last_field = $element;
	}
	
	$first_field->setAttr('class','nofocus');
	
	$un = $this->name.'_'.($u+1);
	
	// Focusing first field triggers loading of additional form. This way it has plenty of time to load
	// by the time this form is filled out. Also drop binding to avoid double-loading
	$first_field->js('focus',array(
	  $this->js()->append('<div id="'.$un.'"/>'),
	  $this->js()->_selector('#'.$un)->atk4_load($this->api->getDestinationURL(null,
																			   array($this->name=>$u+1,'cut_object'=>$un))),
	  $first_field->js()->unbind('focus'),
	));
	
	// Bluring of last field will submit theform
	$last_field->js('blur', $form->js()->submit() );
	
	if($form->isSubmitted()){
	  
	  echo "form is being submitted";
	  
	  $form->js()->fadeOut()->execute();
	}
  }
}
