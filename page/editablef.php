<?php
class page_editablef extends Page {
    public $descr='Grid inline editing with row reloading. Possibly the less known feature of Grid is it\'s ability to use
        inline editing. You can enable this by using "inline" column type. There is a limitation of editing only one field at
        a time. For more complex edits, you can use expanders';
	function page_index(){

$this->add('View_Error')->set('inline fields are currently not working properly.');

		$this->g=$g = $this->add('Grid');
		//$g->addColumn('grid/inline','name');
		//$g->addColumn('grid/inline','email');
		//$g->addColumn('expander','comments');
		$g->setModel('Employee');
		$g->addFormatter('name','grid/inline')->editFields(array('name','salary'));
//		$g->addFormatter('salary','grid/inline');
	}
    function page_comments(){
        $this->add('Text')->set('id='.(int)$_GET['id']);
    }
}
