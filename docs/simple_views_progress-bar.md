Progress Bar Examples
====


    
    Progress Bar 1

    $button=$page->add('Button')->set('Run Long Process');

    $dialog=$page->add('View');
    $progress=$dialog->add('View');
    
    $dialog->add('Text')->set('Executing action on the server...');

    $progress->js(true)->progressbar();

    $dialog->js(true)->dialog(array('autoOpen'=>false,'modal'=>true,
        'title'=>'Processing long action'));

    $button->js('click',array(
        $dialog->js()->dialog('open'),
        $progress->js()->progressbar('value',1)
            ->find('.ui-progressbar-value')
            ->animate(
                array('width'=>'100%'),
                5000,
                $dialog->js()
                    ->dialog('close')
                    ->_enclose()
            )
         )
     );
