# Dialogs and Frames

## Frame

### Action on close

    $page->add('Button')
        ->set('Click me')
        ->js('click')->univ()->frameURL('Nothing here',
            $page->api->url('interactive-views/dialog-and-frames/onclose-event')
        );