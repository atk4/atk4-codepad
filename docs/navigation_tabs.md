# Tabs

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