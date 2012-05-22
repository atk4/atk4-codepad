<?php
class Model_Menu extends hierarchy\Model_Array {
    /** Convert array into proper format */
    function convertArray($array){
        $res=array();
        foreach($array as $key=>$row){
            $r=array(
                'page'=>$key,
                'name'=>$row
            );

            if(is_array($r['name'])){
                $r['children']=$r['name'];
                $r['name']=array_shift($r['children']);
            }
            if($r['children'])$r['children']=$this->convertArray($r['children']);

            $res[]=$r;
        }
        return $res;
    }
    function init(){
        parent::init();

        $this->setSource($this->convertArray(array(
            'about'=>'About This Site',

            'gui'=>array(
                'User Interface',
                'form'=>'Form',
                'grid'=>'Grid',
                'buttons'=>'Buttons',
                'upload'=>'File Uploads',
            ),
            'layouts'=>array(
                'Changind Layout and Design',
                'frames'=>'Frames and Containers',
            ),
            'interaction'=>array(
                'Interaction and JavaScript',
                'binding'=>'Event Binding',
                'chains'=>'Multiple Chains',
                'closures'=>'JavaScript Closures',
                'univ'=>'Universal Library univ.js',
                'custom'=>'Extending JavaScript',
                'form-widget'=>'Form Widget',
                'ajax'=>'Basic AJAX',
                'ajax-widget'=>'AJAX with Views',
            ),
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
            'comparison'=>array(
                'ATK4 vs [other framework]',
                'zend'=>'Zend Framework',
                'code-igniter'=>'Code Igniter',
                'koolphp'=>'KoolPHP',
            ),
            'addons'=>array(
                'Add-ons',
                'password-strength'=>'Testing Password Strength',
                'inline-grid'=>'Grid In-Line editing',
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
