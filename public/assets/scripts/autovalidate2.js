var debug=true;
var updates=[];

$(document).ready(function(){
    tester('Entered in debug mode');
    scanForm();
    jsHide();
});


function scanForm(){
    var formItem=$('#channel_update .ajaxSend');
    tester('Entered ScanForm');
    tester(formItem.length+" items found inside the form scanner");
    for(var i=0;i<formItem.length;i++){
        var item=formItem[i];
        tester(item);
        item.addEventListener("change",function(){
            autoSend(this);
        },true);
        tester('Event Listener is now attaching to item');
    }
}


function autoSend(element){
     tester('Change Detected and Fires Preforming function');
    index=parseInt($(element).attr("data-index"));
    tester(index);
    var settings=settingArea(index);
    updates.push(settings);
    
    if(settings!=null){
        tester("Found a Setting");
        tester(settings);
    }else{
        tester("No Settings Found");
    }
    
    var xhr= new XMLHttpRequest();
    xhr.open('POST','/dynamo/updateAjax',true);
    xhr.onreadystatechange=function(){
        tester("Current Response State "+this.readyState);
        if(this.status==200 && this.readyState==4){
            tester("Server Responded "+this.responseText);
            acknowledge(this.responseText);
        }
    }
    var select=$(settings).find("input[type=radio]:checked");
    var name=select.attr("name");
    var value=select.attr('value');
    tester("Parameters\nName: "+name+" Value: "+value);
    var parameters=name+"="+value;
    
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    xhr.send(parameters)
}


function settingArea(index){
    var settings=$(".setting");
    var setting;
    for(var i=0;i<settings.length;i++){
        var item=settings[i];
        tester(item);
        var Sindex=parseInt($(item).attr('data-setting'));
        tester("Index to be tested against "+index+ " is "+Sindex);
        if(Sindex==index){
            tester('index matches');
            return item;
        }
    }
    return null;
}

function acknowledge(code){
    tester("Acknowledgement Reached\nFuther Code implemented to display to user");
    var setting=updates.shift();
    tester(setting);
    var oldCountry=$(setting).find(".country span");
    oldCountry.html(code);
    //place code to display update below
    
}


function jsHide(){
    $(".JShide").hide();
}

function selectGetValue(select){
    return select.options[select.selectedIndex].value;
}


function tester(param){
    if(debug){
        console.log(param);
    }
}