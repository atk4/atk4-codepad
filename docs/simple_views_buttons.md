# Buttons

* [Regular buttons](#regular-buttons)
* [Button sets](#button-sets)
* [Icons](#icons)
* [Sizes](#sizes)
* [Button size](#button-size)
* [Colors](#colors)
* [Button with menu](#button-with-menu)
* [Button with popover](#button-with-popover)
* [Button / Radio](#button-radio)
* [Toolbar](#toolbar)

### <a id="regular-buttons"></a>regular buttons

    $page->add('Button');

### <a id="button-sets"></a>button sets

    $set = $page->add('ButtonSet');
    $set->addButton('Add');
    $set->addButton('Close');
    $set->addButton('Exit');
    $set->addButton('Other Action');

### <a id="icons"></a>icons

<a href="http://jquery-ui.googlecode.com/svn/tags/1.6rc5/tests/static/icons.html" target="_blank">More jQueryUI icons</a>

    $page->add('Button')->set('Icon Button')->setIcon('ui-icon-heart');

### <a id="sizes"></a>sizes

    $page->add('Button')->set('Small Button')->addClass('small');
    $page->add('Button')->set('Regular Button');
    $page->add('Button')->set('Big Button')->addClass('big');

### <a id="button-size"></a>button size

    $button = $page->add('View_Button')->set('span2')->addClass('span2');
    $button = $page->add('View_Button')->set('span3')->addClass('span3');
    $button = $page->add('View_Button')->set('span4')->addClass('span4');
    $button = $page->add('View_Button')->set('span5')->addClass('span5');
    $button = $page->add('View_Button')->set('span6')->addClass('span6');

### <a id="colors"></a>colors

    $page->add('Button')->set('Red Button')->addClass('red');
    $page->add('Button')->set('Green Button')->addClass('green');
    $page->add('Button')->set('Yellow Button')->addClass('yellow');

### <a id="button-with-menu"></a>button with menu

    $button = $page->add('View_Button');
    $popover = $form = $button->addPopover(array('width'=>'500'));
    $popover->add('LoremIpsum',array('paragraphs'=>1,'words'=>50));
    $buttons = $popover->add('ButtonSet');
    $buttons->addButton('Alert')
        ->js('click')
        ->univ()
        ->alert('BINGOOO!');
 
    $buttons->addButton('Close')
        ->js('click', $popover->js()->dialog('close'));

### splited button with menu

    $button = $page->add('View_Button');
    $form = $button->addSplitButton()->addPopover()->add('Form');
    $form->addClass('stacked');
    $form->addField('Slider','volume');

### button with dropdown menu

    $button = $page->add('Button');
    $menu = $button->addMenu();
     
    $menu->addMenuItem('one');
    $menu->addMenuItem('two');
    $sm = $menu->addSubMenu('submenu');
    $menu->addMenuItem('three');
    $menu->addMenuItem('four');
     
    $sm -> addMenuItem('half');
    $sm -> addMenuItem('quarter');

### splited button with dropdown menu

    $tb = $page->add('View_ButtonMenuButton')->set('Test');
    $menu = $tb->addButtonMenu()->setType('vertical');
    $menu->addMenuItem('open','Open...')
        ->addMenuItem('save','Save')
        ->sub()
            ->addMenuItem('saveas','Save as...')
        ->end()
        ->addMenuItem('delete','Delete')
    ;

### <a id="button-with-popover"></a>button with popover

    // TODO

### <a id="button-radio"></a>button / radio

    // TODO

### <a id="toolbar"></a>Toolbar

    // TODO
    




