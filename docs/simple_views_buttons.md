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

    $page->add('Button')->set(['Icon Button','icon'=>'heart']);

### <a id="sizes"></a>sizes

    $page->add('Button')->set('Small Button')->addClass('atk-button-small');
    $page->add('Button')->set('Regular Button');
    $page->add('Button')->set('Large Button')->addClass('atk-button-large');

### <a id="button-size"></a>button size

    $button = $page->add('View_Button')->set('span2')->addClass('atk-col-2');
    $button = $page->add('View_Button')->set('span3')->addClass('atk-col-3');
    $button = $page->add('View_Button')->set('span4')->addClass('atk-col-4');
    $button = $page->add('View_Button')->set('span5')->addClass('atk-col-5');
    $button = $page->add('View_Button')->set('span6')->addClass('atk-col-6');

### <a id="colors"></a>colors

    $page->add('Button')->set('Red Button')->addClass('atk-swatch-red');
    $page->add('Button')->set('Green Button')->addClass('atk-swatch-green');
    $page->add('Button')->set('Yellow Button')->addClass('atk-swatch-yellow');

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
    $sm = $menu->addSubMenu('test');
    $menu->addMenuItem('three');
    $menu->addMenuItem('four');

    $sm -> addMenuItem('half');
    $sm -> addMenuItem('quarter');




