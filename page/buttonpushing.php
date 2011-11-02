<?php
class page_buttonpushing extends Page {
    public $descr='Sample demonstration on how to use buttons and how to use events. First button relads itself when clicked.
        Second button perfoms animation withotu consulting server. Third button send request to server to receive instructios
        to do the animation. Those are 3 major interaction styles you\'ll use in your application.';
	function init(){
		parent::init();

		$b=$this->add('Button')->set($_GET['cnt']?"Clicked {$_GET['cnt']} times":'Counter');
		$b->js('click')->reload(array('cnt'=>$_GET['cnt']+1));

		// Client side event handling
		$this->add('Button')->set('Client-side JS')->js('click')->animate(array('left'=>'+=10px'));


		// Server side event handling
		$b2=$this->add('Button')->set('Server-side JS');
		if($b2->isClicked())$b2->js()->animate(array('left'=>'+='.rand(10,20).'px'))->execute();
	}
}
