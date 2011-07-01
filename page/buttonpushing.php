<?php
class page_buttonpushing extends Page {
	function init(){
		parent::init();

		$b=$this->add('Button')->set($_GET['cnt']?"Clicked {$_GET['cnt']} times":'Counter');
		$b->js('click')->reload(array('cnt'=>$_GET['cnt']+1));

		// Client side event handling
		$this->add('Button')->set('Client-side JS')->js('click')->animate(array('left'=>'+=10px'));


		// Server side event handling
		$b2=$this->add('Button')->set('Server-side JS');
		if($b2->isClicked())$b2->js()->animate(array('left'=>'+='.rand(10,20).'px'))->execute();

		$this->add('Hangman');
	}
}
class Hangman extends HtmlElement {
	function init(){
		parent::init();
		if(!$_GET[$this->name]){
			$this->add('H3')->set('Select Difficulty');
			$f=$this->add('Form');
			$f->addField('radio','difficulty')->setValueList(array(10=>'Easy',5=>'Medium',3=>'Hard'));
			$f->addSubmit('Start Game');
			if($f->isSubmitted()){
				$this->memorize('word','back');
				$this->memorize('tries',$f->get('difficulty'));
				$this->memorize('letters',range('a','z'));
				$this->js()->reload(array($this->name=>1))->execute();
			}
			return;
		}



		$letter=$_GET[$this->name];
		$word=$this->recall('word');
		$tries=$this->recall('tries');
		$letters=$this->recall('letters');

		$this->api->stickyGET($this->name);
		if($letter!=1){
			unset($letters[array_search($letter,$letters)]);
			if(strpos($word,$letter)===false)$tries--;
			$this->memorize('tries',$tries);
			$this->memorize('letters',$letters);
		}
		$word=str_replace($letters,'-',$word);
		if($tries<0){
			$this->add('P')->set('Game Over');
			return;
		}
		if(strpos($word,'-')===false){
			$this->add('P')->set('You won!');
			return;
		}
		$this->add('H3')->set('Mistakes remaining: '.$tries);
		foreach ($letters as $i){
			$l=$this->add('HtmlElement')
				->setElement('a')
				->setAttr('href','#')
				->set(strtoupper($i))
				->js('click',$this->js()->reload(array($this->name=>$i)));
		}

		$this->add('P')->set('Word: '.$word);
	}
}
