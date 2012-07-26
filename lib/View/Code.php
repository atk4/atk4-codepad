<?php
class View_Code extends View_Example {
    function executeDemo($code){
    }
    function set($code){
    	return parent::set($code,true);
    }
}