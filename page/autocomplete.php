<?php
class page_autocomplete extends Page {
    public $descr='Selecting element in autocomplete field then editing loaded data (or creating new one if it wasn\'t
            selected can be implemented by using two forms. The first form only allows you to change the name of the record,
            then it submits itself and reloads second form.';
    function init(){
        parent::init();

        $form=$this->add('Form');
        $name=$form->addField('autocomplete','name','Employee')->setModel('Employee');
        $form->getElement('name')->js('change',$form->js()->submit());

        $form2=$this->add('MVCForm');
        $model = $form2->setModel('Employee');
        if($_GET['id'])$model->loadData($_GET['id']);
        $form2->addSubmit();
        if($form2->isSubmitted()){
            $form2->update();
            $form2->js()->reload()->execute();
        }

        if($form->isSubmitted()){
            $form2->js()->reload(array('id'=>$form->get('name')))->execute();
        }
    }
}
