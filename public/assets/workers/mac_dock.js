this.addEventListener("message", function (event) {
    this.setting = event.data;
    this.length=Object.keys(this.setting.elements).length;
    center();
    distance();
    size();
    this.postMessage(this.setting);

}, false);

function center() {
    for(var i=0;i<this.length;i++){
        var element=this.setting.elements["item"+i];
        element.cx=element.left+(element.width/2.0);
        element.cy=element.top+(element.height/2.0);
    }
}

function distance(){
    for(var i=0;i<this.length;i++){
        var element=this.setting.elements["item"+i];
        element.distance=distance_calculation(element.cx,element.cy);
    }
}

function distance_calculation(x1,y1){
    x2=this.setting.mouse.x;
    y2=this.setting.mouse.y;
    return Math.sqrt(Math.pow((y2-y1),2.0)+Math.pow((x2-x1),2.0));
}

function size(){
    for(var i=0;i<this.length;i++){
        var element=this.setting.elements["item"+i];
        element.sizeX=element.width;
        if(element.distance<this.setting.image.range){
            element.ratio=element.distance/this.setting.image.range;
            element.ratio=1-element.ratio;
            element.sizeX=this.setting.image.min+(this.setting.image.max-this.setting.image.min)*element.ratio;
        }else{
            element.sizeX=this.setting.image.min;
        }
    }
}