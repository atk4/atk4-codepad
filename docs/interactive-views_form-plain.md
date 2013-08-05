Plain form lacks standard augmentation of Agile Toolkit and submission
handling through POST and AJAX. With Plain Form you can develop either
a basic quick-search form or further customize your own forms.

    // test
    $form = $page->add('Form_Plain');
    $form->add('Text')->set('Search: ');
    $form->addInput('input','q','');
    $form->setAttr('action','/search');
