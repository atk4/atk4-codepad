# Autocomplete


    $model = $page->add('Model_Person');
    
    $form = $page->add('Form');
    $field = $form->addField('autocomplete/Basic','bla');
    $field->setModel($model);

    $form->addSubmit('Save');
