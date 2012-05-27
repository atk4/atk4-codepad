<?php
class View_Example extends View {
    function set($code,$silent=false){

        $short=$this->short_name;

        list($line,$code) = explode("\n",$code,2);
        if($line){
            $this->template->trySet('title',$line);
            $this->s=$line;
            $short=preg_replace('/[^a-zA-Z0-9]/','',$line);
        }

        if($_GET['cut']==$short)$this->api->example_cut=$this;

        $this->template->trySet('short',$short);

        $brush='Php';
        if($this->template->is_set('brush')){
            $brush=$this->template->get('brush');
            $this->template->del('brush');
        }


        $this->template->set('Code',$code);

        if(!@$this->api->highlighter_initialized){
            $this->api->jui->addStaticInclude('syntaxhighlighter/scripts/shCore');
            $this->api->jui->addStaticInclude('syntaxhighlighter/scripts/shBrush'.$brush);
            $this->api->jui->addStaticInclude('shJQuery');
            $this->api->jui->addStaticStylesheet('shCoreDefault','.css','js');
            $this->api->highlighter_initialized=true;
        }

        $this->js(true)->_selector('#'.$this->name.'_ex')->syntaxhighlighter(array('lang'=>$brush));


        if($_GET['cut'])return;

        $res=$this->executeDemo($code);

        if($silent===true){
            $res->destroy();
            $this->template->del('has_demo');
        }
    }
    function executeDemo($code){
        $page=$this->add('View',null,'Demo');
        $page->template->setHTML('Content','<b>The example was executed successfully, but did not produce any output</b>');
        eval($code);
        return $page;
    }

    function defaultTemplate(){
        if($_GET['cut'])return array('view/example_cut');
        return array('view/example');
    }
}
