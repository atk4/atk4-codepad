<?php
class page_layouts_playground extends Page {
    function init(){
        parent::init();
        $this->api->redirect('playground');
    }
}
