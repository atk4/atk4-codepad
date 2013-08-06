###There is nothng here. Just try to close this frame to see jQueryUI 'dialogbeforeclose' trigger


    $v = $page->add('View','view_inside_frame');
    $v->js(true)->closest(".ui-dialog")->on("dialogbeforeclose",
        $page->js(null,'function(event, ui){
                 alert("Text will be changed now!");
                 '. $page->js()->_selector('#'.$_GET['reload_view'])->trigger('reload') .';
             }
        ')
    );