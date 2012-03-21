<?php

class Form_Field_myfield extends Form_Field_line {
    function init(){
        parent::init();
        $this->js(true)->autocomplete(array('source'=>
            $this->api->getDestinationURL(null,array($this->name=>true))));
    }
    function setModel($m){
        $m=parent::setModel($m);

        if($_GET[$this->name]){
            $data=$m->dsql()
                ->where('name like','%'.$_GET['term'].'%')
                ->field('name')
                ->do_getAll();

            array_walk($data,function(&$item,$key){
                $item=array_shift($item);
            });

            echo json_encode($data);
            exit;
        }
    }
}
