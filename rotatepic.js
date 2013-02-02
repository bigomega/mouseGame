var last_position = {},
    mousemove_ok  = true,
    mouse_timer   = setInterval(function () {
        mousemove_ok = true;
    }, 1),
    x=0,
    y=0;

$(document).bind('mousemove',addMyEvent);

var addMyEvent=function (event) {
        if (mousemove_ok) {
            mousemove_ok = false;
        x=event.clientX;
        y=event.clientY;
        if (typeof(last_position.x) != 'undefined') {
            var deltaX = last_position.x - event.clientX,
                deltaY = last_position.y - event.clientY,
                m=10;
            if(deltaX!=0)
                m=deltaY/deltaX

            m=Math.abs(m);
            if(m>0.5 && m<2){
                //diagonal
                if(deltaX>0){
                    //left
                    if(deltaY>0){
                        //left top
                        $("body").removeClass().addClass("nw");
                    }
                    else{
                        //left bottom
                        $("body").removeClass().addClass("sw");
                    }
                }
                else{
                    //right
                    if(deltaY>0){
                        //right top
                        $("body").removeClass().addClass("ne");
                    }
                    else{
                        //right bottom
                        $("body").removeClass().addClass("se");
                    }
                }
            }
            else if(m>2){
                //vertical
                if(deltaY>0){
                    //top
                    if($("body").hasClass("s")){
                        $("body").removeClass().addClass("sw").delay(30).queue(function(next){
                            $(this).removeClass().addClass("w").delay(30).queue(function(next){
                                $(this).removeClass().addClass("nw").delay(30).queue(function(next){
                                    $(this).removeClass().addClass("n");
                                    next();});
                                next();});
                            next();});
                    }
                    else if($("body").hasClass("se")){
                        $("body").removeClass().addClass("e").delay(30).queue(function(next){
                            $(this).removeClass().addClass("ne").delay(30).queue(function(next){
                                $(this).removeClass().addClass("n");
                                next();});
                            next();});
                    }
                    else if($("body").hasClass("sw")){
                        $("body").removeClass().addClass("w").delay(30).queue(function(next){
                            $(this).removeClass().addClass("nw").delay(30).queue(function(next){
                                $(this).removeClass().addClass("n");
                                next();});
                            next();});
                    }
                    else if($("body").hasClass("e")){
                        $("body").removeClass().addClass("ne").delay(50).queue(function(next){
                            $(this).removeClass().addClass("n");
                            next();});
                    }
                    else if($("body").hasClass("w")){
                        $("body").removeClass().addClass("nw").delay(50).queue(function(next){
                            $(this).removeClass().addClass("n");
                            next();});
                    }
                    else
                        $("body").removeClass().addClass("n");
                }
                else{
                    //bottom
                    if($("body").hasClass("n")){
                        $("body").removeClass().addClass("ne").delay(30).queue(function(next){
                            $(this).removeClass().addClass("e").delay(30).queue(function(next){
                                $(this).removeClass().addClass("se").delay(30).queue(function(next){
                                    $(this).removeClass().addClass("s");
                                    next();});
                                next();});
                            next();});
                    }
                    else if($("body").hasClass("ne")){
                        $("body").removeClass().addClass("e").delay(30).queue(function(next){
                            $(this).removeClass().addClass("se").delay(30).queue(function(next){
                                $(this).removeClass().addClass("s");
                                next();});
                            next();});
                    }
                    else if($("body").hasClass("nw")){
                        $("body").removeClass().addClass("w").delay(30).queue(function(next){
                            $(this).removeClass().addClass("sw").delay(30).queue(function(next){
                                $(this).removeClass().addClass("s");
                                next();});
                            next();});
                    }
                    else if($("body").hasClass("e")){
                        $("body").removeClass().addClass("se").delay(50).queue(function(next){
                            $(this).removeClass().addClass("s");
                            next();});
                    }
                    else if($("body").hasClass("w")){
                        $("body").removeClass().addClass("sw").delay(50).queue(function(next){
                            $(this).removeClass().addClass("s");
                            next();});
                    }
                    else
                        $("body").removeClass().addClass("s");
                }
            }
            else{
                //horizontal
                if(deltaX>0){
                    //left
                    if($("body").hasClass("e")){
                        $("body").removeClass().addClass("se").delay(30).queue(function(next){
                            $(this).removeClass().addClass("s").delay(30).queue(function(next){
                                $(this).removeClass().addClass("sw").delay(30).queue(function(next){
                                    $(this).removeClass().addClass("w");
                                    next();});
                                next();});
                            next();});
                    }
                    else if($("body").hasClass("se")){
                        $("body").removeClass().addClass("s").delay(30).queue(function(next){
                            $(this).removeClass().addClass("sw").delay(30).queue(function(next){
                                $(this).removeClass().addClass("w");
                                next();});
                            next();});
                    }
                    else if($("body").hasClass("ne")){
                        $("body").removeClass().addClass("n").delay(30).queue(function(next){
                            $(this).removeClass().addClass("nw").delay(30).queue(function(next){
                                $(this).removeClass().addClass("w");
                                next();});
                            next();});
                    }
                    else if($("body").hasClass("s")){
                        $("body").removeClass().addClass("sw").delay(50).queue(function(next){
                            $(this).removeClass().addClass("w");
                            next();});
                    }
                    else if($("body").hasClass("n")){
                        $("body").removeClass().addClass("nw").delay(50).queue(function(next){
                            $(this).removeClass().addClass("w");
                            next();});
                    }
                    else
                        $("body").removeClass().addClass("w");
                }
                else{
                    //right
                    if($("body").hasClass("w")){
                        $("body").removeClass().addClass("nw").delay(30).queue(function(next){
                            $(this).removeClass().addClass("n").delay(30).queue(function(next){
                                $(this).removeClass().addClass("ne").delay(30).queue(function(next){
                                    $(this).removeClass().addClass("e");
                                    next();});
                                next();});
                            next();});
                    }
                    else if($("body").hasClass("sw")){
                        $("body").removeClass().addClass("s").delay(30).queue(function(next){
                            $(this).removeClass().addClass("se").delay(30).queue(function(next){
                                $(this).removeClass().addClass("e");
                                next();});
                            next();});
                    }
                    else if($("body").hasClass("nw")){
                        $("body").removeClass().addClass("n").delay(30).queue(function(next){
                            $(this).removeClass().addClass("ne").delay(30).queue(function(next){
                                $(this).removeClass().addClass("e");
                                next();});
                            next();});
                    }
                    else if($("body").hasClass("s")){
                        $("body").removeClass().addClass("se").delay(50).queue(function(next){
                            $(this).removeClass().addClass("e");
                            next();});
                    }
                    else if($("body").hasClass("n")){
                        $("body").removeClass().addClass("ne").delay(50).queue(function(next){
                            $(this).removeClass().addClass("e");
                            next();});
                    }
                    else
                        $("body").removeClass().addClass("e");
                }
            }
            /*
            else if (Math.abs(deltaX) > Math.abs(deltaY) && deltaX > 0) {
                //left
                $("body").removeClass().addClass("w");
            } else if (Math.abs(deltaX) > Math.abs(deltaY) && deltaX < 0) {
                //right
                $("body").removeClass().addClass("e");
               
            } else if (Math.abs(deltaY) > Math.abs(deltaX) && deltaY > 0) {
                //up
                $("body").removeClass().addClass("n");
                
            } else if (Math.abs(deltaY) > Math.abs(deltaX) && deltaY < 0) {
                //down
                $("body").removeClass().addClass("s");
                
            }*/
        }
        last_position = {
            x : event.clientX,
            y : event.clientY
        };
    }
}