<?php
class page_dragaction extends Page {
    public $descr='Using custom view with a custom template to display your own HTML and even enable drag and drop. Agile
        Toolkit helps you even if you build your own components. Here we also specify a custom JavaScript which uses
        univ().ajaxec() to send data back to the server.';

	function init(){
		parent::init();


		// memorize and recall are methods which allow us to store data in session. The major advantage
		// is having session variables associated with your object. Multiple object would have unique
		// storage.
		if($this->add('Button')->setLabel('Reset')->isClicked()){
			$this->memorize('allocated',array());
			$this->js()->reload()->execute();
		}

		$this->allocated=$this->recall('allocated',array());

		$people=array(
				array( 'id'=>1, 'name'=>'John'), 
				array( 'id'=>2, 'name'=>'Peter'), 
				array( 'id'=>3, 'name'=>'Jojo'), 
				array( 'id'=>4, 'name'=>'Kevin'), 
				);
		$tasks=array(
				array( 'id'=>3, 'name'=>'Write Report'), 
				array( 'id'=>6, 'name'=>'Wash Dishes'), 
				array( 'id'=>8, 'name'=>'Submit Taxes'), 
				);

		// To display output in our preferable format we are using Lister class. 
		// We make our own class based on Lister which behaves the way we want.
		$left=$this->add('PersonList',null,'People','People')
			->setStaticSource($people);

		$right=$this->add('TaskList',null,'Tasks','Tasks')
			->setStaticSource($tasks);

		$right->js(true)->children('div')->draggable();
		$left->js(true)->children('div')->droppable(array(
			'drop'=>$this->js(null,'function(event,ui){ $.univ().ajaxec({ 0:"'.
					$this->api->url().'", person_id: $(this).attr("data-id"),'.
				'task_id: $(ui.draggable).attr("data-id") }); } ')
		));

		// js(null,'..js code..') allows to insert EXACT javascript code where you want.
		// beware though, you will need to do your own escaping. It's always a better
		// idea to define method in your JS include


		// When we execute AJAX action from the droppable widget, we are calling our own URL with 
		// two extra arguments. Here we handle that request
		if(isset($_GET['person_id']) && isset($_GET['task_id'])){

			$this->allocate($_GET['task_id'],$_GET['person_id']);

			$js=array();
			$js[]=$this->js()->univ()->successMessage('Dragged '.((int)$_GET['task_id']).' into '.((int)$_GET['person_id']));
			$js[]=$this->js()->reload();

			$this->js(null,$js)->execute();
		}

		// Show some more sources
		$this->add('ViewSource','s_personlist','Sources')->setFile($f='lib/PersonList.php')
			->template->trySet('title','Source of '.$f);

		$this->add('ViewSource','s_tasklist','Sources')->setFile($f='lib/TaskList.php')
			->template->trySet('title','Source of '.$f);

		$this->add('ViewSource','s_dragaction','Sources')->setFile($f='templates/default/page/dragaction.html')
			->template->trySet('title','Source of '.$f);
	}

	function allocate($task,$person){
		$this->allocated[$task]=$person;
		$this->memorize('allocated',$this->allocated);
	}

	function defaultTemplate(){
		return array('page/dragaction');
	}
}
