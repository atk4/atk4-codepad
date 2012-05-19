<?php
class page_myformat extends Page {
    function init(){
        parent::init();
        $this->api->dbConnect();
        $m=$this->add('Model_Employee');
        $m->getField('salary')->display(array('grid'=>'myfield'));
        $this->add('MVCGrid')->setModel($m);
    }
}

if(!class_exists('Grid',false)){
class Grid extends Grid_Basic {
    function format_myfield($field){
        $this->current_row[$field]='CUSTOM FORMAT';
    }
}
}
