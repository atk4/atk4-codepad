<?php
class page_index extends Page {
    public $descr='This page shows the index of all the pages available under this installation of Agile Toolkit. Since all
        the pages are classes we can somewhat "peek" into them and grab the descriptions out, as we produce array with all
        examples and their descriptions';
    function init(){
        parent::init();
        $p=$this;

        $this->add('View_Error')->setHTML('This site is currendly being upgraded. Archives are always available at 
            <a href="https://github.com/atk4/atk4-codepad" target="_blank">https://github.com/atk4/atk4-codepad</a>');

        /*

        $data=array();
        $files=$this->api->pathfinder->searchDir('page','');
        foreach($files as $key=>$val){
            $row=array();
            $name=preg_replace('/[^a-zA-Z0-9].*       /','',$val);

            $row['name']=$name;

            $path=$this->api->locate('page',$name.'.php');
            $class='page_'.$name;

            include_once($path);
            $c=new $class;
            if(isset($c->skip))continue;
            $row['descr']=preg_replace('/([\.\?]).*       /s','$1',@$c->descr);
            $data[]=$row;
        }


        $l=$this->add('Lister',null,null,array('view/example'));
        $l->setStaticSource($data);
        $l->safe_html_output=false;
         */
    }

    function defaultTemplate(){
        return array('page/index');
    }
}
