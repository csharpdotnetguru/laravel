var customGridster = {
	init: function(gridsterContainerEl) {
		var gridster = $(gridsterContainerEl).gridster({

	        widget_margins: [10, 10],
	        widget_base_dimensions: [130, 130],
			serialize_params: function($w, wgd) { 
	            return { 
					htmlContent: $($w).html(),
					id: $($w).attr('id'),
					class: $($w).attr('class'),
					link: $($w).data('link-url'),
					dataStep: $($w).data('step'),
					dataIntro: $($w).data('intro'),
					col: wgd.col, 
					row: wgd.row, 
					size_x: wgd.size_x, 
					size_y: wgd.size_y 
	            } 
    	},
		draggable: {
			stop: function(e, ui, $widget) {
				var gridPos = gridster.serialize();
	    			localStorage.setItem('gridPos', JSON.stringify(gridPos));
				//console.log('stop dragging');

			},
			start: function(e, ui) {
				customGridster.isDragging = true;
				//console.log('start dragging');
			}
		}

    }).data('gridster');

    	return gridster;
	},
	retriveGridPos: function() {
		return JSON.parse(localStorage.getItem('gridPos'));
	},
	loadDefaultPos: function(defaultGridPos, gridster) {
		//console.log('Loading Default Grid');
		$.each(defaultGridPos, function() {
	    	var el = gridster.add_widget('<li data-step="' + this.dataStep + '"  data-intro="' + this.dataIntro + '"  data-link-url="' + this.link + '" class="gridster ' + this.class + '" id=' + this.id +'>' + this.htmlContent + '</li>' , this.size_x, this.size_y, this.col, this.row);
	 		el.wrap('<a class="no-link-style" href="' + this.link + '"></a>')
	 		//console.log(this.link);
	 	});				
	},
	loadSavedPos: function(savedGridPos, gridster) {
		//console.log('Loading Saved Grid');
	    $.each(savedGridPos, function() {
	    	var el = gridster.add_widget('<li data-step="' + this.dataStep + '"  data-intro="' + this.dataIntro + '"  data-link-url="' + this.link + '" class="gridster ' + this.class + '" id=' + this.id +'>' + this.htmlContent + '</li>' , this.size_x, this.size_y, this.col, this.row);
	 		el.wrap('<a class="no-link-style" href="' + this.link + '"></a>')
	 		//console.log(this.link);


	    }); 				
	},
	initLoadGrid: function(defaultGridPos, savedGridPos, gridsterContainerEl) {

		var gridster = this.init(gridsterContainerEl);
		customGridster.preventClickOnDrag(gridsterContainerEl);

		if(savedGridPos != null) {
			//console.log('has saved data');
      		this.loadSavedPos(savedGridPos, gridster);
    	}
		else {
			//console.log('has no data');
   			this.loadDefaultPos(defaultGridPos, gridster);
		}			
	},
	preventClickOnDrag: function(gridsterContainerEl){
		gridsterContainerEl.on('click','a', function(e){ 
			if(customGridster.isDragging == true) {
				//console.log('preventing click event while dragging');
				customGridster.isDragging = false;
				e.preventDefault();
			}
		});
	}
};

var infiniteWiggle = {
	loop: function(el) {
		el.ClassyWiggle('start');
		
		setTimeout(function() {
			el.ClassyWiggle('stop');
		}, 2000); 
	},
	startWiggle: function(el) {
		 this.wiggleSetIntervalId = setInterval(function(){
		 	infiniteWiggle.loop(el);
		 }, 4000);
	},
	// startWiggle: setInterval(function(){
	// 	 	infiniteWiggle.loop();
	// 	 }, 1000),
	stopWiggle: function() {
		clearInterval(this.wiggleSetIntervalId);
		//console.log(this.wiggleSetIntervalId);
	}
};



$(function(){

	//Load Grid Position from Localstorage
	var savedGridPos = customGridster.retriveGridPos();
	var gridsterContainerEl = $('.gridster').find('ul');
	customGridster.initLoadGrid(defaultGridPos, savedGridPos, gridsterContainerEl);

	$('.wiggle.start').click(function() {
		//console.log('clicked to start wiggle');
		infiniteWiggle.startWiggle();
	}); 

	
	checkStatus.initCheck(dnsStatusApiLink, accountStatusApiLink);


}) 


