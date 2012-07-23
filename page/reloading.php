<?php
class page_reloading extends Page {
    function init(){
        parent::init();
        $this->api->redirect('interaction/reloading');

    }
}
