var reSizer = {
	centerEl: function (el, parentEl) {
		var parentlWidth = parentEl.width();
		var parentHeight = parentEl.height();

		var objWidth = el.width();
		var objHeight = el.height();

		//console.log(parentlWidth);


		el
		.css('left', parentlWidth/2 - objWidth/2 )
		.css('top', parentHeight/2 - objHeight/2 );

		// console.log('parent div width ' + parentDivWidth);
		// console.log('parent div height ' + parentDivHeight);
	},

	elResize: function (el, parentEl, heightPercent, widthPercent) {
		var parentWidth = parentEl.width();
		var parentHeight = parentEl.height();

		var objWidth = el.width();
		var objHeight = el.height();


		//console.log('parent width is ' + parentWidth);
		//console.log('obj width is ' + objWidth);

		//console.log('obj height is ' + objHeight);
		//console.log('parent height is ' + parentHeight);



		if(widthPercent == undefined) {
			//console.log('no width, resize based on height only; width is auto.');
			el.css('height', (parentHeight * heightPercent) );		
		}
		else if(heightPercent == undefined) {
			//console.log('no height, resize based on width only; height is auto.');
			el.css('width', (parentWidth * widthPercent) );	
		}
		else {
			//console.log('resize width and height');
			el
			.css('width', (parentWidth * widthPercent) )
			.css('height', (parentHeight * heightPercent) );
		}

		//console.log('parent div width ' + parentWidth);
		//console.log('parent div height ' + parentHeight);
	}
};
