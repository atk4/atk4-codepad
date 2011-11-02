<?php
class TaskList extends MVCLister {
	function formatRow(){
		$id=$this->current_row['id'];

		$this->current_row['allocated']=print_r($this->owner->allocated[$id],true);
	}
}

