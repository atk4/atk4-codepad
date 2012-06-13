<?php
class TaskList extends CompleteLister {
	function formatRow(){
		$id=$this->current_id;


		$this->current_row['allocated']=print_r($this->owner->allocated[$id],true);
	}
}

