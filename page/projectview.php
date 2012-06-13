<?php
class page_projectview extends Page {
	function init(){
		parent::init();
		$this->api->stickyGET('e');
		$this->api->template->trySet('title',strtoupper($_GET['e']));
		
		$base='example/'.$_GET['e'];
		if($this->api->template->hasTag('SubMenu')){
			$this->api->tree=$this->api->add('TreeView',null,'SubMenu',array('submenu'));
			$this->api->tree->setModel('Directory')
				->sub('templates','templates/default/page')
				->setBasePath($base);
		}

		// only show files from the example directories

		if($_GET['p']){
			if(substr($_GET['p'],0,strlen($base)) != $base)exit;
			$this->api->stickyGET('p');
			if(!preg_match('/^[\/a-z1-9A-Z-]*(\.php|\.html)?$/',$_GET['p']))exit;

			$this->add('ViewSource')->setFile($_GET['p']);

		}else{
			$this->add('P')->set('You are exploring project files. Select the files on the left to see the source');
			$this->add('P')->setHTML('You can also browse this on github');
		}
	}
}

/**
 * Traverses into directories producing model with all files
 */
class Model_Directory extends hierarchy\Model_Array {

	public $substitute=array();

	function sub($dir,$dir2){
		$this->substitute[$dir]=$dir2;
		return $this;
	}

	function setBasePath($path,$depth=5){
		if(!preg_match('/^[\/a-z1-9A-Z]*$/',$path))exit;
		$x=$this->traverse($path,$depth);

		foreach($x as $k1=>&$top)if($top['children']){
			foreach($top['children'] as $k2=>&$l2)if($l2['children']){
				$x[]=array(
					'name'=>$top['name'].'/'.$l2['name'],
					'page'=>$l2['page'],
					'children'=>$l2['children']
					);
				unset($top['children'][$k2]);
			}

		}

		$this->setSource($x);
	}

	function traverse($path,$depth){
		if(!$depth)return array();
		$res=array();
		$d=opendir($path);
		while($file=readdir($d)){
			if($file[0]=='.')continue;

			if($this->substitute[$file])$file=$this->substitute[$file];

			$item=array();
			$item['name']=$file;
			if(is_dir($path.'/'.$file)){
				$item['children']=$this->traverse($path.'/'.$file,$depth-1);
			}else{
				$item['page']=$this->api->url(null,array('p'=>$path.'/'.$file));
			}
			$res[]=$item;
		}
		return $res;
	}
}

