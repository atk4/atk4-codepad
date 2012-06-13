<?php
class page_myformat extends Page {
    function init(){
        parent::init();
        $this->api->dbConnect();
        $m=$this->add('Model_Employee');
        $m->getField('name')->display('myfield');
        $m->getField('salary')->display(array('grid'=>'myfield'));

        $this->add('MyGrid')->setModel($m);
    }
}

class MyGrid extends Grid{
    function format_myfield($field){
        //$this->current_row_html[$field]='CUSTOM FORMAT: '.$this->current_row[$field];
        $this->current_row_html[$field]='<u>CUSTOM FORMAT</u>: '.$this->current_row[$field];
    }
}
