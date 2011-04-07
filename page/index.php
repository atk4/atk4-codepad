<?php
class page_index extends Page {
    function init(){
        parent::init();
        $p=$this;


    }

    function defaultTemplate(){
        return array('page/index');
    }
}
