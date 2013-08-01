# Top Tabs

    $tabs = $page->add('Tabs');
    $tabs->addTab('Home','index');
    $tabs->addTab('Buttons','buttons')->add('Button')->set('this is button');
    $tabs->addTab('Lipsum','lipsum')->add('LoremIpsum');
    $form_tab = $tabs->addTab('Form','form');

    $form = $form_tab->add('Form');
    $form->addField('Line','string');
    $form->addSubmit('Click');
    $form->onSubmit(function($form){
        $form->js()->univ()->alert($form->get('string'))->execute();
    });
    
# Bottom Tabs

    $tabs = $page->add('Tabs');
    $tabs->toBottom();
    $tabs->addTab('Lipsum','lipsum')->add('LoremIpsum');
    $tabs->addTab('Buttons','buttons')->add('Button')->set('this is button');
    $form_tab = $tabs->addTab('Form','form');

    $form = $form_tab->add('Form');
    $form->addField('Line','string');
    $form->addSubmit('Click');
    $form->onSubmit(function($form){
        $form->js()->univ()->alert($form->get('string'))->execute();
    });
    
# Left Tabs

    $tabs = $page->add('Tabs');
    $tabs->toLeft();
    $tabs->addTab('Lipsum','lipsum')->add('LoremIpsum');
    $tabs->addTab('Buttons','buttons')->add('Button')->set('this is button');
    $form_tab = $tabs->addTab('Form','form');

    $form = $form_tab->add('Form');
    $form->addField('Line','string');
    $form->addSubmit('Click');
    $form->onSubmit(function($form){
        $form->js()->univ()->alert($form->get('string'))->execute();
    });

# Right Tabs

    $tabs = $page->add('Tabs');
    $tabs->toRight();
    $tabs->addTab('Lipsum','lipsum')->add('LoremIpsum');
    $tabs->addTab('Buttons','buttons')->add('Button')->set('this is button');
    $form_tab = $tabs->addTab('Form','form');

    $form = $form_tab->add('Form');
    $form->addField('Line','string');
    $form->addSubmit('Click');
    $form->onSubmit(function($form){
        $form->js()->univ()->alert($form->get('string'))->execute();
    });

    