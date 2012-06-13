<?php
class ViewSource extends View {


	function setFile($f){
		$brush='Php';
        if($this->template->is_set('brush')){
            $brush=$this->template->get('brush');
            $this->template->del('brush');
        }

        $this->template->set('Code',file_get_contents($f));

        if(!@$this->api->highlighter_initialized){
        	$this->api->jui->addStaticInclude('syntaxhighlighter/scripts/shCore');
        	$this->api->jui->addStaticInclude('syntaxhighlighter/scripts/shBrush'.$brush);
        	$this->api->jui->addStaticInclude('shJQuery');
        	$this->api->jui->addStaticStylesheet('shCoreDefault','.css','js');
        	$this->api->highlighter_initialized=true;
        }

        $this->js(true)->_selector('#'.$this->name.'_ex')->syntaxhighlighter(array('lang'=>$brush));

        $this->template->trySet('short',$this->short_name);
        $this->template->tryDel('has_demo');
        return $this;
    }

    function defaultTemplate(){
    	if($_GET['cut'])return array('view/example_cut');
    	return array('view/example');
    }


}