$.each({
    softScroll: function(a){

        function setFocus(d){
            d.effect('highlight',2000);

            console.log(d);

            $("html, body").animate({ scrollTop: d.offset().top-100 }, 500);
        }

        if ("onhashchange" in window) {
            $('[name]').each(function(){
                var t=$(this);
                t.attr('name','ss_'+t.attr('name'));
            });


            $(window).bind('hashchange',function(){
                var h = location.hash.slice(1);
                var d=$('[name=ss_'+h+']');
                if(d.parent().is('.gutter')){
                    var t=d.children().addClass('highlighted').text();
                    d.parent().next().find('.number'+t).addClass('highlighted');
                }
                if(d.length==1)setFocus(d);
            });
        }

        var h=document.location.hash.substr(1);
        var d=$('[name=ss_'+h+']');
        if(d.length==1){
            console.log(d,d.is(':visible'));
            if(d.parent().is('.gutter')){
                var t=d.children().addClass('highlighted').text();
                d.parent().next().find('.number'+t).addClass('highlighted');
            }
            if(!d.is(':visible'))d=d.closest(':visible');
            setFocus(d);
        }
    }
},$.univ._import
);
