<?php
class FileGrid extends MVCGrid {
	function setModel($m){
		parent::setModel($m,array('id','filestore_type','name_size'));
		$this->dq->order('id desc')->limit(10);
	}
}
