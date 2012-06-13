<?php
class page_editablef extends Page {
    public $descr='Grid inline editing with row reloading. Possibly the less known feature of Grid is it\'s ability to use
        inline editing. You can enable this by using "inline" column type. There is a limitation of editing only one field at
        a time. For more complex edits, you can use expanders';
	function page_index(){

$this->add('View_Error')->set('inline fields are currently not working properly.');

		$this->g=$g = $this->add('Grid');
		$g->addColumn('inline','name');
		$g->addColumn('inline','email');
		$g->addColumn('expander','comments');
		$g->setSource('movie');
	}
    function page_comments(){
        $this->add('Text')->set('id='.(int)$_GET['id']);
    }
}
