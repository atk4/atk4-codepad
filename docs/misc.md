Creating method in all objects
----


    $myfunc=function($obj)use($page){
        $page->add('P')->set('Hello, '.$obj->name);
    });

    $page->api->addHook('beforeObjectInit',$myfunc);