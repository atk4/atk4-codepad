<?php
class Frontend extends ApiFrontend {
	function init(){
		parent::init();

		// Add jQuery UI and connect to database
		$this->add('jUI');
		$this->dbConnect();

		// Creates menu on top
		$menu=$this->add('Menu',null,'Menu');
		$menu->addMenuItem('books');
		$menu->addMenuItem('members');
		$menu->addMenuItem('staff');
		$menu->addMenuItem('history');
	}

	function page_index(){
		$this->add('View_Info')->set('This example data is available for public edit. If you find that content on the pages is empty or is vandalized, please click this button to re-initialize database');
		if($this->add('Button')->set('Reset Database')->isClicked()){
			$this->db->query('delete from library_borrowing');
			$this->db->query('delete from library_book');
			$this->db->query('delete from library_member');
			$this->db->query('delete from library_staff');
			$this->db->query("INSERT INTO `library_book` VALUES (1,'Adaptation as Compendium: Tim Burton\'s Alice in Wonderland','1755-0637'),(2,'The Ultimate Hitchhiker\'s Guide to the Galaxy','0345391802')");
			$this->db->query("INSERT INTO `library_member` VALUES (1,'Joe Blogs','029982'),(2,'Ken Thompson','00777')");
			$this->db->query("INSERT INTO `library_staff` VALUES (1,'Dennis Ritchie'),(2,'Will Smith')");
			$this->db->query("INSERT INTO `library_borrowing` VALUES (2,1,1,1,'2012-06-12','1','2012-06-12'),(4,2,2,1,'2012-06-12','1','2012-06-12'),(5,2,1,1,'2012-06-12','0',NULL)");
			$this->js()->univ()->successMessage('Database cleaned up successfully')->execute();
		}

	}
}