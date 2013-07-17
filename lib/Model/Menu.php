<?php
class Model_Menu extends hierarchy\Model_Array {
    /** Convert array into proper format */
    function convertArray($array,$prefix=''){
        $res=array();
        foreach($array as $key=>$row){
            $r=array(
                'page'=>$this->api->url($prefix.$key),
                'name'=>$row
            );

            if(is_array($r['name'])){
                $r['children']=$r['name'];
                $r['name']=array_shift($r['children']);
            }
            if($r['children'])$r['children']=$this->convertArray($r['children'],$prefix.$key.'/');

            $res[]=$r;
        }
        return $res;
    }
    function init(){
        parent::init();

        $this->setSource($this->convertArray(array(
            'index'=>'About This Site',

            'gui'=>array(
                'User Interface',
                'form'=>'Forms',
                'formstyle'=>'Form Styling',
                'grid'=>'Grids',
                'validation'=>'Form Validation',
                //'upload'=>'File Uploads',
                'menu'=>'Menu',
                'button-set'=>'Button Set',
            ),
            'layouts'=>array(
                'Changind Layout and Design',
                'playground'=>'Standard CSS styles',
               // 'frames'=>'Frames and Containers',
            ),
            'interaction'=>array(
                'Interaction and JavaScript',
                'reloading'=>'Dynamic pages and AJAX',
                'binding'=>'JavaScript Bindings',
            ),
            'model'=>array(
                'Using Models',
                'def'=>'Defining Models',
            ),
            /*
            'features'=>array(
                'Advanced Features',
                'custom-form-fields'=>'Custom Form Fields',
                'security'=>'Injection Protection',
                'db'=>'Database Connection',
                'auth'=>'Authorization',
                'git'=>'Usage with Git and SVN',
                'dbupdate'=>'SQL Upgrade Tracking',
            ),
            'snippets'=>array(
                'Useful Snippets',
                'sub-selector'=>'Country and State',
                'entry-form'=>'Data-entry soltions',
            ),
            */
            'comparison'=>array(
                'ATK4 vs [other framework]',
                'datamapper'=>'CI DataMapper ORM',
                //'code-igniter'=>'Code Igniter',
                //'koolphp'=>'KoolPHP',
            ),
            /*
            'addons'=>array(
                'Add-ons',
                'password-strength'=>'Testing Password Strength',
                'jqgrid'=>'Integration with jqGrid',
            ),
             */
            'old'=>array(
                'Older Examples',
                '50employees'=>'50employees',
                '50employees2'=>'50employees2',
                'autocomplete'=>'autocomplete',
                'buttonpushing'=>'buttonpushing',
                'columns'=>'columns',
                'contact'=>'contact',
                'dragaction'=>'dragaction',
                'editablef'=>'editablef',
                'facebook'=>'facebook',
                'hangman'=>'hangman',
                'hello'=>'hello',
                'image'=>'image',
                'infiniteadd1'=>'infiniteadd1',
                'issue12'=>'issue12',
                'jsonac'=>'jsonac',
                'layoutswitch'=>'layoutswitch',
                /*
                'metatags'=>'metatags',
                'multiupload'=>'multiupload',
                'myformat'=>'myformat',
                'newsletter'=>'newsletter',
                'projectview'=>'projectview',
                'quicksearch'=>'quicksearch',
                'reloadform'=>'reloadform',
                'reloadformac'=>'reloadformac',
                'reloadtest'=>'reloadtest',
                'salesphotos'=>'salesphotos',
                'slider'=>'slider',
                'slotmachine'=>'slotmachine',
                'stackcrud'=>'stackcrud',
                'tmail'=>'tmail',
                ''=>'',
                 */
                )
            )));
}

/** creates a field, which shows number of children for every entry */
function addChildCount($field){

        // Implementation for Array
    foreach($this as $row){

    }
}
}
