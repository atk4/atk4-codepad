<?php
class page_reloadtest extends Page {
    public $descr='Ilustrates how you can reload parts of the page either using reload() or form/reloadField';

	function init(){
		parent::init();
		$p=$this;

		$v=$p->add('LoremIpsum')->setLength(1,50);
		$b=$p->add('Button')->set('Reload')->js('click',$v->js()->reload());

		$g=$p->add('Grid');
		$g->addColumn('text','gender');
		$g->addColumn('text','name');
		$g->addColumn('text','surname');
		$g->setSource('user');
        if($_GET['g'])$g->dq->where('gender',$_GET['g']);

		$g->addButton('Male')->js('click',$g->js()->reload(array('g'=>'M')));
		$g->addButton('Female')->js('click',$g->js()->reload(array('g'=>'F')));

		$f=$p->add('Form');
		$fi=$f->addField('dropdown','fi')->setValueList(array(rand(1,20),2,3));
		$fi->add('Button',null,'after_field')->set('Reload')->js('click',$f->js()->atk4_form('reloadField','fi'));

	}
}
