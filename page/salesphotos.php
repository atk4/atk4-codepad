<?php
class page_salesphotos extends Page {
    function init(){
        parent::init();

        $this->api->jquery->addStaticInclude('tiny_mce/jquery.tinymce');

        $tabs=$this->add('Tabs');
        $p = $tabs->addTab('Pages')->add('CRUD');
        $p->setModel('Pages',array('label','headline','status','content'),array('label','headline','status'));

        $s = $tabs->addTab('Sales')->add('CRUD');
        $s->setModel('Sales');
        if($s->form){
            $em=$s->form->getElement('name');
            $em->js(true)->tinymce(array('script_url'=>'/templates/js/tiny_mce/tiny_mce.js'));

            $em=$s->form->getElement('email')->allowMultiple(10);
        }

        $t = $tabs->addTab('Sections')->add('CRUD');
        $t->setModel('Sections');
    }
}

class SomeModel extends Model_Table {
    public $entity_code='user';
    function init(){
        parent::init();
        $this->addField('name');
    }
}

class Model_Pages extends SomeModel {
}

class Model_Sales extends SomeModel {
    function init(){
        parent::init();

        $this->getField('name')->type('text')->allowHtml(true);
        $this->addField('email')->refModel('Model_Filestore_File')->type('file')->display('upload');
    }
}
class Model_Sections extends SomeModel {
}
if(!class_exists('Grid',false)){
class Grid extends Grid_Basic {
    function format_referenece(){
    }
}
}
