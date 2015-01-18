var unoWizard = {
	init: function(defaultUnoWizardId, targetEl) {
		unoWizard.loadDefault(defaultUnoWizardId, targetEl);
		unoWizard.restart(defaultUnoWizardId, targetEl);
		unoWizard.goTo(targetEl);	
	},
	loadDefault: function(defaultUnoWizardId, targetEl) {
		var currentUnoWizardId = localStorage['currentUnoWizardId-' + targetEl];
		if( currentUnoWizardId === undefined) {
			var currentUnoWizardId = defaultUnoWizardId;
			//console.log('no stored question');
		}		
		else {
			//console.log('has stored question; restarting from last');
		}
		var el = $('div').find('.' + targetEl);
		el.find('.uno-wizard').hide();
		el.find('div[data-uno-wizard-id=' + currentUnoWizardId + ']').fadeIn();
	},
	restart: function(defaultUnoWizardId, targetEl) {
		$('.restart-uno-wizard').on('click', function() {
			localStorage.removeItem('currentUnoWizardId-' + targetEl);
			unoWizard.loadDefault(defaultUnoWizardId, targetEl);
		});
	},
	goTo: function(targetEl) {
		var el = $('div').find('.' + targetEl);
		el.find('input[type=radio][name=uno-wizard]').change(function() {

			var unoWizardId = $(this).data('uno-wizard-go-id');

			//Store current wizard id
			localStorage['currentUnoWizardId-' + targetEl] = unoWizardId;

			$(this).closest('div.uno-wizard').hide();
			$('div[data-uno-wizard-id=' + unoWizardId + ']').fadeIn();

		});					
	}
};
