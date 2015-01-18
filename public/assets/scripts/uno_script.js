window.debug = false;
function log(obj) {
    if (window.debug)
        console.log(obj);
}
/******************************/

$(window).resize(function(){
    window.requestAnimationFrame = window.mozRequestAnimationFrame || window.mozRequestAnimationFrame;
    if (typeof window.requestAnimationFrame == "function")
        requestAnimationFrame(uno_fill);
    else
        uno_fill();
});


$(document).ready(function () {
    log("ready");
    $(document).trigger('page:load');
});


$(document).on('page:load', function () {
    window.requestAnimationFrame = window.mozRequestAnimationFrame || window.mozRequestAnimationFrame;
    function setup() {
        uno_menu();
        uno_image();
        uno_fill();
    }

    if (typeof window.requestAnimationFrame == "function")
        requestAnimationFrame(setup);
    else
        setup();
});


function uno_menu() {
    var menu = $('.uno_menu');
    var menu_items = menu.find('li');
    var container = $(document.createElement('div'));
    container.addClass('uno_menu_gen');

    menu_items.each(function () {
        var element = $(this);
        var classname = element[0].className;
        var value = element.html();
        var item = $(document.createElement('div'));
        item.addClass(classname);
        item.append(value);
        container.append(item);
    });

    menu.before(container);
    menu.css('display', 'none');
}


function uno_image() {
    var images = $('.uno_image');
    images.each(function () {
        var image = $(this);
        var classname = this.className;
        classname = classname.replace('uno_image', '');
        classname = $.trim(classname);
        var container = $(document.createElement('div'));
        container.addClass('uno_image_gen');
        container.addClass(classname);
        image.before(container);
        image.remove();
        container.append(image);
    });
}

function uno_fill(){
    var elements=$('.fill');
    log(elements);
    elements.each(function(){
        var element=$(this);
        var parent=element.parent();
        log(parent);
        var before=element.prev();
        window.setTimeout(function(){
            var before_end=before.offset().left+before.width();
            log(before_end);
            var width=0;
            var temp=parseInt(element.css('margin-left'));
            log(temp);
            log(width);
            width+=parseInt(element.css('margin-right'));
            log(width);
            width+=parseInt(element.css('padding-left'));
            log(width);
            width+=parseInt(element.css('padding-right'));
            log(width);
            var parent_width=parent.innerWidth();
            width=parent_width-before_end-width;
            log(width);
            width*=.95;
            element.css('min-width',width+"px");
            element.css('max-width',width+"px");
        },10);
    });
}