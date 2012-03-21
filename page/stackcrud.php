<?php
class page_stackcrud extends Page {
    function init(){
        parent::init();
        $page=$this;

        $tabs = $page->add('Tabs');
        $tabs->addTab('Product')->add('CRUD')->setModel('Product');
    }

}
class Model_Category extends Model_Table { public $entity_code='user'; }
class Model_Picture extends Model_Table { public $entity_code='user'; }
//class Model_Category extends Model_Table { public $entity_code='user'; }
//class Model_Category extends Model_Table { public $entity_code='user'; }
class Model_Product extends Model_Table
{
    public $entity_code = 'product';

    function init()
    {
        parent::init();

        $this->addField('category_id')->refModel('Model_Category')->mandatory(true);
        $this->addField('name')->mandatory(true);
        $this->addField('picture_id')->refModel('Model_Picture')->mandatory(true);
        $this->addField('short_description')->mandatory(true);
        $this->addField('description')->type('text')->mandatory(true);
        $this->addField('uploaded_at')->type('datetime');
        $this->addField('price')->type('int')->mandatory(true);
        $this->addField('quantity')->type('int')->mandatory(true);
        $this->addField('status')->datatype('list')
            ->listData(array(
                        'enabled'=>'Enabled',
                        'disabled'=>'Disabled',
                        ))
            ->defaultValue('enabled');
    }
}


