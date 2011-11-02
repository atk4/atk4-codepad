<?php
class page_hangman extends Page {
    public $descr='Hangman implementation in AJAX within just 50 lines of code is amazing way to show efficiency of
        development in Agile Toolkit. This example demonstrates object-level session control and AJAX reloading. Objects in
        Agile Toolkit are independent and even placing 2 games on same page won\'t break a thing!';
    function init(){
        parent::init();
        $this->add('H1')->set('Play Hangman!');
        $this->add('Hangman');
        $this->add('H2')->set('Care for another game?');
        $this->add('Hangman');
    }
}
