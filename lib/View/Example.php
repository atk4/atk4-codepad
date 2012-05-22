<?php
class View_Example extends View {
    function set($code){
        $this->template->set('Code',$code);
        // TODO: make a dynamic paths here
        if(!@$this->api->syntaxhighligter_hack)
            $this->js(true,'$.SyntaxHighlighter.init({prettifyBaseUrl:"templates/js/jquery-syntaxhighlighter/prettify",baseUrl:"templates/js/jquery-syntaxhighlighter"})')->_load('jquery-syntaxhighlighter/scripts/jquery.syntaxhighlighter');
        $this->api->syntaxhighligter_hack=true;

		$res=$this->add('View',null,'Demo');
		$this->executeDemo($res,$code);
    }
	function executeDemo($page,$code){
		eval($code);
	}
    
    function defaultTemplate(){
        return array('view/example');
    }
}
