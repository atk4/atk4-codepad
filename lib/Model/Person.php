<?php
class Model_Person extends Model_Table {
	public $table='person';
	public $table_alias='p';
	function init(){
		parent::init();

		$this->addField('name');
	}
}
