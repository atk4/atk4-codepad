$.each({
    softScroll: function(a){

        if ("onhashchange" in window) {
            $('[name]').each(function(){
                var t=$(this);
                t.attr('name','ss_'+t.attr('name'));
            });


            $(window).bind('hashchange',function(){
                var h = location.hash.slice(1);
                var d=$('[name=ss_'+h+']');
                if(d.length==1){
                    $("html, body").animate({ scrollTop: d.offset().top-100 }, 500);
                }
            });
        }

        var h=document.location.hash.substr(1);
        var d=$('[name=ss_'+h+']');
        if(d.length==1){
            if(!d.is(':visible'))d=d.closest(':visible');
            $("html, body").animate({ scrollTop: d.offset().top-100 }, 500);
        }
    }
},$.univ._import
);
