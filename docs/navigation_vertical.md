# Vertical menu

    $this->menu = $page->add('Menu',null,null,array('menu','MenuVertical'));
    $this->menu
         ->addMenuItem('index','Home')
         ->addMenuItem('about','About')
         ->addMenuItem('contacts','Contacts')
    ;