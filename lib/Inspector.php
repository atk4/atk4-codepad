<?php
  
class Inspector extends View {
    function initButtons(){
        $page=$this->api->page_object;

        $tabs=$this->add('Tabs');

        // add Info Tab
        $basic=$tabs->addTab('About');
        $source=$tabs->addTab('Source');
        $share=$tabs->addTab('Share');

        $p=explode('_',$this->api->page);


        $basic->add('H3')->set(ucwords($p[0]));
        if($page->descr)$basic->add("P")->set($page->descr);

        $form=$share->add('Form');
        $form->setFormClass('vertical');
        $field=$form->addField('line','link','Share this link')->set(
                $this->api->getDestinationURL()->useAbsoluteURL());
        $field->js('click')->select();


        /* Add [View Template] Button if custom template is used */
        if(($t=$page->defaultTemplate())!=array('page') && is_array($t)){
            $source->add('Button')->set('Page template')
                ->js('click')
                ->univ()->frameURL('Page Source',$this->api->getDestinationURL(null,array('pagetemplate'=>true)
                            ),array('height'=>'700'));
            if($_GET['pagetemplate']){
                $this->api->renderOnly($this->add('SourceViewer')->load('template',$t[0].'.html'));
            }
        }

        $source->add('H3')->set('Component Sources');
        $node=$source->add('TreeNode')->useObject($page);
        $this->showChildren($page,$node);

        $source->add('HR');
        $source->add('Button')->set('Inspector Source')
            ->js('click')
            ->univ()->frameURL('Inspector Source',$this->api->getDestinationURL(null,array('inspectorsrc'=>true)
                            ),array('height'=>'700'));
        if($_GET['inspectorsrc']){
            $this->api->renderOnly($this->add('SourceViewer')->load('php','Inspector.php'));
        }
        $source->add('Button')->set('Source Viewer\'s Source')
            ->js('click')
            ->univ()->frameURL('Source Viewer\'s Source',$this->api->getDestinationURL(null,array('sourceviewsrc'=>true)
                            ),array('height'=>'700'));
        if($_GET['sourceviewsrc']){
            $this->api->renderOnly($this->add('SourceViewer')->load('php','SourceViewer.php'));
        }
    }
    function showChildren($sorc,$dest){
        foreach($sorc->elements as $key=>$obj){
            if($obj instanceof jQuery_Chain)continue;
            if(!is_object($obj))continue;
            $node=$dest->add('TreeNode')->useObject($obj);
            if($obj->elements)$this->showChildren($obj,$node);
        }
    }
    function defaultTemplate(){
        return array('view/toolbox');
    }
}
class TreeNode extends View {
    function useObject($obj){
        if(!is_object($obj))throw $this->exception('not object');
        $this->template->set('name',$obj->name);
        $this->template->set('class',get_class($obj));
        if($obj instanceof Page){
            $this->js('click')->_selector('#'.$this->name.'_a')
                ->univ()->frameURL('Page Source',$this->api->getDestinationURL(null,array('source'=>true)
                            ),array('height'=>'700'));
            if($_GET['source']){
                $p=explode('_',$this->api->page);
                $this->api->renderOnly($this->add('SourceViewer')->load('page',$p[0].'.php'));
            }
            return$this;
        }
        $this->js('click')->_selector('#'.$this->name.'_a')
            ->univ()->frameURL('Inspecting object '.$obj->name,$this->api->getDestinationURL(null,
                        array('inspect'=>$this->name)
                        ),array('height'=>'700'));
        if($_GET['inspect']==$this->name){
            return $this->api->renderOnly($v=$this->add('SourceViewer')
                    ->load('php',str_replace('_','/',$this->sourceSubst(get_class($obj))).'.php'));
        }
        if(!$obj instanceof AbstractView)return$this;
        $this->js('mouseover',$obj->js()->css('background','pink'))->_selector('#'.$this->name.'>a');
        $this->js('mouseleave',$obj->js()->css('background',''))->_selector('#'.$this->name.'>a');



        return $this;
    }
    function sourceSubst($class){
        if($class=='Form')return 'Form_Basic';
        if($class=='Columns')return 'View_Columns';
        if($class=='Form_Field_Line')return 'Form_Field';
        if($class=='Grid')return 'Grid_Basic';
        if($class=='Button')return 'View_Button';
        return $class;
    }
    function defaultTemplate(){
        return array('view/treenode');
    }
}
