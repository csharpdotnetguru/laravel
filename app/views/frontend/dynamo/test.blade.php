<!DOCTYPE HTML>

<html>
<head>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <style type="text/css">
        .dock {
            position: absolute;
            bottom: 0;
            display: block;
            margin: auto;
            padding: 0;
        }

        .dock img {
            position: relative;
            vertical-align: bottom;
        }
    </style>
</head>

<body>
<h1>click me</h1>

<div class='slider'>
    <div class="dock">
        <img id="first" class='pic1' src='http://cdn.unotelly.com/unodns/images/channels/netflix.png'/>
        <img class='pic2' src='http://cdn.unotelly.com/unodns/images/channels/hulu.png'/>
        <img class='pic3' src='http://cdn.unotelly.com/unodns/images/channels/pandora.png'/>
        <img class='pic3' src='http://cdn.unotelly.com/unodns/images/channels/spotify.png'/>
        <img class='pic3' src='http://cdn.unotelly.com/unodns/images/channels/bbciplayer.png'/>
        <img class='pic1' src='http://cdn.unotelly.com/unodns/images/channels/netflix.png'/>
        <img class='pic2' src='http://cdn.unotelly.com/unodns/images/channels/hulu.png'/>
        <img class='pic3' src='http://cdn.unotelly.com/unodns/images/channels/pandora.png'/>
        <img class='pic3' src='http://cdn.unotelly.com/unodns/images/channels/spotify.png'/>
        <img class='pic3' src='http://cdn.unotelly.com/unodns/images/channels/bbciplayer.png'/>
        <img class='pic1' src='http://cdn.unotelly.com/unodns/images/channels/netflix.png'/>
        <img class='pic2' src='http://cdn.unotelly.com/unodns/images/channels/hulu.png'/>
        <img class='pic3' src='http://cdn.unotelly.com/unodns/images/channels/pandora.png'/>
        <img class='pic3' src='http://cdn.unotelly.com/unodns/images/channels/spotify.png'/>
        <img class='pic3' src='http://cdn.unotelly.com/unodns/images/channels/bbciplayer.png'/>
    </div>
</div>


<script>

    if (window.Worker) {
        var thread = new Worker("/assets/workers/mac_dock.js");
    }
    if (window.mozRequestAnimationFrame) {
        window.requestAnimationFrame = window.mozRequestAnimationFrame;
    }
    if (window.requestAnimationFrame == undefined) {
        $(".dock img").css("-webkit-transition", "none");
        $(".dock img").css("transition", "none");
        window.requestAnimationFrame = function (callback) {
            callback.apply(this);
        }
    }
    window.timer = {};
    window.timer.fps = 1000/60;
    window.image = {};
    window.image.max = 150;
    window.image.min = 50;
    window.image.range = 300;
    window.image.elements=$(".dock img");

    window.debug = false;
    function log() {
        if (window.debug == undefined) {
            window.debug = false;
        }
        if (window.debug) {
            console.log.apply(console, arguments);
        }
    }

    $(document).on("mousemove", function (e) {
        if (window.timer.mousemove == undefined)
            window.timer.mousemove = setTimeout(mousemove_event, window.timer.fps, e);

    });

    function mousemove_event(e) {
        var images=window.image.elements;
        var setting = {};
        setting.mouse = {};
        setting.mouse.x = e.pageX;
        setting.mouse.y = e.pageY;
        setting.image={};
        setting.image.max=window.image.max;
        setting.image.min=window.image.min;
        setting.image.range=window.image.range;


        setting.elements={};

        var length = images.length;
        for (var i = 0; i < length; i++) {
            var element=$(images.get(i));
            setting.elements["item"+i]={};
            setting.elements["item"+i].left=element.offset().left;
            setting.elements["item"+i].top=element.offset().top;
            setting.elements["item"+i].width=element.width();
            setting.elements["item"+i].height=element.height();
        }
        thread.postMessage(setting);
    }

    thread.addEventListener("message",function(e){
        update_icon(e);
    },false);

    function update_icon(e){
        var setting= e.data;
        var length=Object.keys(setting.elements).length;
        var images=window.image.elements;

        for (var i = 0; i < length; i++) {
            var element=$(images.get(i));
            var options={};
            options.width=setting.elements["item"+i].sizeX;
            element.css(options);
            console.log(setting.elements["item"+i].ratio);
        }
        console.log("made it");


        delete window.timer.mousemove;

    }


</script>

</body>
</html>
