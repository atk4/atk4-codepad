# Navigation bar

    $unique_id = md5(time());
    $tabs = $page->add('Tabs',$unique_id);
    $tabs->addTabURL('index','Home');
    $tabs->addTabURL('simple_views/progress-bar','Progress Bar');
    $tabs->addTabURL('simple_views/buttons','Buttons');