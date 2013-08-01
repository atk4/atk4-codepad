This is standard jQuery UI Tooltip

    //ok

    $bar = $page->add('ButtonSet');
    $bar->addButton('One')->setAttr('title','Button One');
    $bar->addButton('Two')->setAttr('title','Another Button');

    $bar->js(true)->children()->tooltip();
