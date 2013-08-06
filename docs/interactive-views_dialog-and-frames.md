# Dialogs and Frames

## Frame

### Action on close


    // add view which will be reloaded
    $v = $page->add('View')->setElement('h1');

    // this will change text after view reload
    if ($_GET['text']) {
        $v->set('text is: '.$_GET['text']);
    } else {
        $v->set('-------------------');
    }
    
    // reload action. Send new text as a get pagameter
    $v->js('reload')->atk4_reload(
            $page->api->url(null,array(
                'text'=>'This is text after reload','cut_object'=>$v->name
            ))
    );

    // botton to open frame
    $page->add('Button')
        ->set('Click me')
        ->js('click')->univ()->frameURL('Nothing here',
            $page->api->url('interactive-views/dialog-and-frames/onclose-event',array(
                'reload_view' => $v->name
            ))
        );