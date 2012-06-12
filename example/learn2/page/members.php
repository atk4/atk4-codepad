<?php
class page_members extends Page {

	// This page consists of 3 sub-pages. I placed them in the same file for easire access.

	function page_index(){

		$m=$this->add('Model_Member');

		// Dynamically add expression showing number of currently borrowed books by member
		$m->addExpression('books')->set($m->refSQL('BorrowingNow')->count())
			->caption('Borrowed');
		
		// Add CRUD for managing members
		$cr=$this->add('CRUD');
		$cr->setModel($m);

		// Enhance CRUD
		if($cr->grid){

			// Add quick-search by name and issn and also convert 'Borrowed' column into expander
			$cr->grid->addQuickSearch(array('name','issn'));
			$cr->grid->addFormatter('books','expander');

			// Add button allowing for a member to borrow a book
			$cr->grid->addColumn('button','borrow');

			// Grid's button will execute AJAX request with borrow=<id>
			if($_GET['borrow']){

				// Get the name of currently selected member
				$name = $cr->grid->model->load($_GET['borrow'])->get('name');

				// Open frame with member's name in the title. Load content through AJAX from subpage
				$this->js()->univ()->frameURL('New borrowing by '.$name,
					$this->api->url('./borrow',array('id'=>$_GET['borrow'])))
					->execute();
			}
		}

	}

	function page_books(){
		$m=$this->add('Model_Book');

		// Dynamically change model to include only related entires
		$bor=$m->join('library_borrowing.library_book_id');

		// We might need more fields from joined table
		$bor->addField('library_member_id');
		$bor->addField('is_returned')->type('boolean');
		$bor->addField('library_borrowing_id','id')->system(true);
		// System fields will not appear in froms and grids by defaultt

		// We are only interested in currently borrowed book by this specific member
		$m->addCondition('library_member_id',$_GET['library_member_id']);
		$m->addCondition('is_returned',false);
		// Normally all this should be stored in model! Keep your UI logic clean

		// Clicking on grid buttons should also pass library_member_id
		$this->api->stickyGET('library_member_id');

		// Place grid in a box with grayish background
		$g=$this->add('View')->addStyle('background','#eee')
			->add('Grid');

		$g->setModel($m,array('name','issn'));
		$g->addColumn('button','return');
		if($_GET['return']){

			// Returning borrowed book by book_id and calling custom model method
			$this->add('Model_Borrowing')->loadBy('library_book_id',$_GET['return'])->returnBook();
			$g->js()->univ()->location($this->api->url('..'))->execute();
		}


	}

	function page_borrow(){

		// This page for borrowing new book
		$m=$this->add('Model_Borrowing');

		// Substitute model for existing field, because we want to show only
		// available books
		$m->getElement('library_book_id')->refModel('Model_BookAvailable');

		// Perform quick check to make sure there are some books to borrow
		if(!$m->ref('library_book_id')->count()->getOne()){
			$this->add('View_Error')->set('No Books to Borrow');
			$this->add('Button')->set('Close')->js('click')->univ()->closeDialog();
			return;
		}

		// Change look of the form, will place labels above fields
		$f=$this->add('Form')->addClass('stacked');
		$f->setModel($m,array('library_book_id','library_member_id','verified_by'));

		// Set default value for a field
		$f->set('library_member_id',$_GET['id']);
		$f->addSubmit();
		if($f->isSubmitted()){

			// will create new record in the database
			$f->update();
			$f->js()->univ()->location($this->api->url('..'))->execute();
		}
	}

}