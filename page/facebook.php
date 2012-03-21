<?php

class page_facebook extends Page {
    public $descr = 'An example of Facebook authorization integration and profile data fetching';
    function init(){
        parent::init();
        $f = $this->add("Controller_OAuth_Facebook");
        $fbtoken = $this->api->recall("fbtoken");
        if (!$fbtoken){
            if ($fbtoken = $f->check()){
                $this->api->memorize("fbtoken", $fbtoken);
                $this->api->redirect($this->api->getDestinationURL());
            }
        } else {
            $c = $this->add("Controller_SNI_Facebook");
            $c->setOAuth($f);
            if (!$this->api->recall("fbuserinfo")){
                $this->api->memorize("fbuserinfo", $c->getUserProfile());
            }
            $info = $this->api->recall("fbuserinfo");
            $this->add("Text")->set("Welcome " . $info->first_name . " " . $info->last_name);
        }
    }

}
