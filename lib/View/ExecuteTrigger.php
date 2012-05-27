<?php
class View_ExecuteTrigger extends View_Example {
    function executeDemo($d){
        if(!$_GET[$this->name]){
            if($this->add('Button',null,'button')->setLabel("Execute \"".$this->s.'"')->isClicked()){
                $this->js()->univ()->frameURL('Execution Result',$this->api->url(null,array($this->name=>1)))->execute();
            }
            return;
        }
        $this->api->stickyGET($this->name);

        $this->template->tryDel('source');
        $o=parent::executeDemo($d);
        $_GET['cut_object']=$o->name;
    }
    function defaultTemplate(){
        if($_GET['cut'])return array('view/example_cut');
        return array('view/execute_trigger');
    }
}
