$(document).on('keyup', '.autotab', null, numberKeyValidation);

//responsible for tracking when the shift key is pressed
$(document).on('keydown', lockShift);

//responsible for tracking when the shift key is released
$(document).on('keyup', unlockShift);

$(document).on('keydown', '.autotab', lockKeys);

$(document).on('input_complete', '.autotab', checkValue);

$(document).ready(detectWindow);

$(window).resize(function(){
    window.uno.menuPress=0;
    detectWindow()
});


function detectWindow() {
    tester($(window).outerWidth());
    if ($(window).outerWidth() < 480) {
        $(document).trigger('mobile');
    } else if ($(window).outerWidth() > 480 && $(window).outerWidth() < 820) {
        $(document).trigger('mobile');
    } else {
        $(document).trigger('desktop');
    }
}


$(document).on('mobile', function () {
    hideSideBar();
    showMenuButton();
});

$(document).on('mobile.off', function () {

});

$(document).on('tablet', function () {
    hideSideBar();
    showMenuButton();
});

$(document).on('tablet.off', function () {

});

$(document).on('desktop', function () {
    showSidebar();
    hideMenuButton();

});

$(document).on('desktop.off', function () {

});

var desktop=800;

if (document.ontouch == undefined)
    var type = "click";
else
    var type = "touch";
$(document).on(type, '.uno_phone_menu_click', function (e) {
    var e = e || window.event;
    var target = e.target;
    if (target) {
        if (!target.clickTime) {
            target.clickTime = 0;
        }
        var clickTime = new Date().getTime();
        if (clickTime - target.clickTime < 300)
            return;
        else
            target.clickTime = clickTime;

    }
    if (window.uno.sidebar) {
        hideSideBar();
    } else {
        showSidebar();
    }
    return false;
});


function showMenuButton() {
    var item = $('.uno-mobile');
    item.each(function () {
        $(this).addClass('uno_show_block');
    });
}

function hideMenuButton() {
    $('.uno-mobile').each(function () {
        $(this).removeClass('uno_show_block');
    });
}

function showSidebar() {
    tester("Showing side bar");
    if (!window.uno) {
        window.uno = {};
        if (!window.uno.firstSlide) {
            window.uno.firstSlide = true;
        }
    }
    if (window.uno.menuPress == undefined)
        window.uno.menuPress = 0;

    var time_press = new Date().getTime();

    if (time_press - window.uno.menuPress < 1000) {
        //console.log("press disallowed");
       // console.log("too soon");
        return;
    }
    else {
        var delta_press = time_press - window.uno.menuPress;
       // console.log("press allowed time is " + delta_press);
        window.uno.menuPress = time_press;
    }


    if (window.uno.sidebar != undefined && window.uno.sidebar == true)
        return;

    window.uno.sidebar = true;
    var sidebar = $('._sidebar-content');
    sidebar.slideDown();
}
var sidebarhide = 0;
function hideSideBar() {
    $('.uno-mobile').removeClass('uno-show-block');
    var sidebar = $('._sidebar-content');
    if (!window.uno) {
        window.uno = {};
        if (!window.uno.firstSlide) {
            window.uno.firstSlide = true;
            sidebar.slideUp(0);
           // console.log("hiding the sidebar first time");
        }
    }

    if (window.uno.menuPress == undefined)
        window.uno.menuPress = 0;

    var time_press = new Date().getTime();

    if (time_press - window.uno.menuPress < 1000) {
        //console.log("press disallowed");
        //console.log("too soon");
        return;
    }
    else {
        var delta_press = time_press - window.uno.menuPress;
        //console.log("press allowed time is " + delta_press);
        window.uno.menuPress = time_press;
    }

    if (window.uno.sidebar != undefined && window.uno.sidebar == false)
        return;
    window.uno.sidebar = false;

   // console.log("Hiding side bar for " + sidebarhide);
    sidebarhide += 1;
    sidebar.slideUp();
}

$(document).ready(setting_equalizer);

function setting_equalizer() {
    return;
    var setting_options = $('.options');
    setting_options.each(function () {
        var element = $(this);
        var country = element.find('.country_info');
        country_equalizer(country);
    });
}

function country_equalizer(country) {
    //var country = $('.country_info');
    var height = [];
    var width = [];
    for (var i = 0; i < country.length; i++) {
        var element = country.get(i);
        height.push($(element).height());
        width.push($(element).width());
    }
    function max(a, b) {
        if (a > b)
            return a;
        else
            return b;
    }

    if (height.length > 0 && width.length > 0) {
        height = height.reduce(max);
        width = width.reduce(max);
        country.height(height);
        country.width(width);
    }
}

function numberKeyValidation(e) {
    //add keys as needed to add keys to the ignore list
    var tab = 9;
    var shift = 16;
    var left = 37;
    var up = 38;
    var right = 39;
    var down = 40;
    var keys = [tab, shift, left, up, right, down];

    //special keys
    var backspace = 8;

    for (var key in keys) {
        if (e.keyCode == keys[key])
        {
            return;
        }

    }
    var element = $(this);

    var tabs = $('.autotab');
    var position = tabs.index(element);

    if (element.hasClass('inputError'))
        element.removeClass('inputError');

    if (element.val().length == element.attr('maxlength') && e.keyCode != backspace) {
        if (position < tabs.length - 1) {
            tabs[position + 1].focus();
            tabs[position + 1].select();
        }
        element.trigger('input_complete');
    }
}

function lockShift(e) {
    var shift = 16;
    if (e.keyCode == shift) {
        tester('shift down');
        if (!window.unotelly)
            window.unotelly = {};
        window.unotelly.shiftLock = true;
    }
}

function unlockShift(e) {
    var shift = 16;
    if (e.keyCode == shift) {
        tester('shift up');
        delete window.unotelly.shiftLock;
    }
}

function lockKeys(e) {

    var message="Please use digits only";
    var element = $(e.target);
    var tab_key = 9;
    var backspace = 8;
    var letters = [65, 90];
    var tabs = $('.autotab');
    var position = tabs.index(element);


    //locks letters out of entering
    if (e.keyCode >= letters[0] && e.keyCode <= letters[1]) {
        e.preventDefault();
        alertify.error(message);
        return;
    }

    //check if shift is pressed and ignore them
    //this is because numbers can't be pressed
    //if shift is pressed
    if (window.unotelly)
        if (window.unotelly.shiftLock && e.keyCode != tab_key) {
            e.preventDefault();
            return;
        }

    //ignore keys over 106 symbols and so forth
    if (e.keyCode >= 106) {
        e.preventDefault();
        return;
    }

    //if the tab key is pressed don't do anything.
    //tab should have the normal use as the user desire
    //they may want to tab through the page.
    if (e.keyCode == backspace && element.val().length == 0) {
        if (position > 0) {
            tabs[position - 1].focus();
            e.preventDefault();
        }
    }
}

function checkValue(e) {
    var element = $(e.target);
    var ip = parseInt(element.val());
    tester(ip);
    tester(isNaN(ip));
    if (ip > 255 || isNaN(ip)) {
        tester('adding class');
        element.addClass('inputError');
        element.focus();
        element.select();
    }
}

$(document).ready(function () {
    tester('Entered in debug mode');
    scanForm();
});

var debug = false;
var updates = [];

$(document).ready(function () {
    tester('Entered in debug mode');
    scanForm();
    jsHide();
});

function scanForm() {
    var formItem = $('#channel_update .ajaxSend');
    tester('Entered ScanForm');
    tester(formItem.length + " items found inside the form scanner");
    for (var i = 0; i < formItem.length; i++) {
        var item = formItem[i];
        tester(item);
        item.addEventListener("change", function () {
            autoSend(this);
        }, true);
        tester('Event Listener is now attaching to item');
    }
}

function autoSend(element) {
    //console.log(element);
    if (!element.clickTime) {
        element.clickTime = 0;
    }

    var clickTime = new Date().getTime();

    if ((clickTime - element.clickTime) < 50) {
        return;
        //this stops multiple spamming to the server
        //for 50 milliseconds
    }
    element.clickTime = clickTime;

    tester('Change Detected and Fires Proforming function');
    index = parseInt($(element).attr("data-index"));
    tester(index);
    var settings = settingArea(index);
    updates.push(settings);

    if (settings != null) {
        tester("Found a Setting");
        tester(settings);
    } else {
        tester("No Settings Found");
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', updateAjax, true);
    xhr.onreadystatechange = function () {
        tester("Current Response State " + this.readyState);
        if (this.status == 200 && this.readyState == 4) {
            tester("Server Responded " + this.responseText);
            acknowledge(this.responseText);
        }
    }
    var select = $(settings).find("input[type=radio]:checked");
    var name = select.attr("name");
    var value = select.attr('value');
    tester("Parameters\nName: " + name + " Value: " + value);
    var parameters = name + "=" + value;

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    xhr.send(parameters)
}

function settingArea(index) {
    var settings = $(".setting");
    var setting;
    for (var i = 0; i < settings.length; i++) {
        var item = settings[i];
        tester(item);
        var Sindex = parseInt($(item).attr('data-setting'));
        tester("Index to be tested against " + index + " is " + Sindex);
        if (Sindex == index) {
            tester('index matches');
            return item;
        }
    }
    return null;
}

function acknowledge(code) {
    var message = jQuery.parseJSON(code);
    tester('message received');
    tester("Acknowledgement Reached\nFuther Code implemented to display to user");
    var setting = updates.shift();
    tester(setting);
    var oldCountry = $(setting).find(".country span");
    oldCountry.html(message.html_replacement);
    if (!window.uno) {
        window.uno = {};
        window.uno.serverResponse = "";
    }

    if (window.uno.serverResponse != message.server_code)
        alertify.success(message.feedback);

    window.uno.serverResponse = message.server_code;
}


function jsHide() {
    $(".JShide").hide();
}

function selectGetValue(select) {
    return select.options[select.selectedIndex].value;
}

$(document).on("click", "#bookmark", bookmark);

function bookmark() {
    return;
    if (window.sidebar) { // Mozilla Firefox Bookmark
        window.sidebar.addPanel(location.href, document.title, "");
    } else if (/*@cc_on!@*/false) { // IE Favorite
        window.external.AddFavorite(location.href, document.title);
    } else if (window.opera && window.print) { // Opera Hotlist
        this.title = document.title;
        return true;
    } else { // webkit - safari/chrome
        alertify.alert('Press ' + (navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? '<b>Command/Cmd</b>' : '<b>CTRL</b>') + ' <b>+ D</b> to bookmark this page so you can update IP address later.');
    }
}


function tester(param) {
    if (debug) {
       // console.log(param);
    }
}
/****************************************************************/
function pop_up() {
    var element = $('.new_form');
    element.css('visibility', 'visible');
    element.hide();
    element.fadeIn(500);
}

function close() {
    $('.new_form').fadeOut(500);
}

function create_new() {
    pop_up();
    var container = $('.new_form .container');
    var xhr = new XMLHttpRequest();
    xhr.open('GET', formUrl);
    xhr.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            container.html(this.responseText);
            tester(this.responseText);
            return this.responseText;
        }
    }
    xhr.send();
}

function edit_old(element) {
    pop_up();
    var link = $(element).attr('data-edit-link');
    tester(link);
    $('.new_form').css('visibility', 'visible');
    var container = $('.new_form .container');
    container.hide();
    var xhr = new XMLHttpRequest();
    xhr.open('GET', link);
    xhr.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
            container.hide();
            container.fadeIn(500);
            container.html(this.responseText);
            tester(this.responseText);
            return this.responseText;
        }
    }
    xhr.send();
}

function finish_new() {
    close();
    $('.new_form .container').html("");
}