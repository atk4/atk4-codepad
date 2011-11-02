<?php
class page_dragaction extends Page {
	function init(){
		parent::init();


		if($this->add('Button')->setLabel('Reset')->isClicked()){
			$this->memorize('allocated',array());
			$this->js()->reload()->execute();
		}

		$this->allocated=$this->recall('allocated',array());

		$people=array(
				array( 'id'=>1, 'name'=>'John'), 
				array( 'id'=>2, 'name'=>'Peter'), 
				array( 'id'=>3, 'name'=>'Jojo'), 
				);
		$tasks=array(
				array( 'id'=>3, 'name'=>'Write Report'), 
				array( 'id'=>6, 'name'=>'Wash Dishes'), 
				array( 'id'=>8, 'name'=>'Submit Taxes'), 
				);


		$left=$this->add('Person',null,'People','People')
			->setStaticSource($people);

		$right=$this->add('Task',null,'Tasks','Tasks')
			->setStaticSource($tasks);

		$right->js(true)->children('div')->draggable();
		$left->js(true)->children('div')->droppable(array(
			'drop'=>$this->js(null,'function(event,ui){ $.univ().ajaxec({ 0:"'.
					$this->api->getDestinationURL().'", person_id: $(this).attr("data-id"),'.
				'task_id: $(ui.draggable).attr("data-id") }); } ')
		));

		if($_GET['person_id'] && $_GET['task_id']){

			$this->allocate($_GET['task_id'],$_GET['person_id']);

			$js=array();
			$js[]=$this->js()->univ()->successMessage('Dragged '.((int)$_GET['task_id']).' into '.((int)$_GET['person_id']));
			$js[]=$this->js()->reload();

			$this->js(null,$js)->execute();

		}
	}

	function allocate($task,$person){
		$this->allocated[$task]=$person;
		$this->memorize('allocated',$this->allocated);
	}

	function defaultTemplate(){
		return array('page/dragaction');
	}
}

class Task extends MVCLister {
	function formatRow(){
		$id=$this->current_row['id'];

		$this->current_row['allocated']=print_r($this->owner->allocated[$id],true);
	}
}

class Person extends MVCLister {
}
