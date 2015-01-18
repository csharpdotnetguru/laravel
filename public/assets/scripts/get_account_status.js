
    var dns_status_api = 'https://setupcheckapi.unotelly.com/index.php?callback=?&type=json';
    var account_status_api = 'https://api.unotelly.com/api/v1/sub/account_status?callback=?&type=json';
    
    /*
    var dns_status = new Object();
    	dns_status.dns_status = 'true';

 	var data = new Object();
        data.known_user = true;
        data.no_sub = false;
        data.expired = false;
        data.sub_suspended = false;

	display_action(dns_status, data);

	*/


    function get_dns_status(dns_status_api, account_status_api) {
        $.getJSON(dns_status_api, function (data) {
            //console.log(data);
            get_account_status(data, account_status_api);
        });
    }

    function get_account_status(dns_status, account_status_api) {
        $.getJSON(account_status_api, function (data) {
            //console.log(data);
            display_action(dns_status, data)
        }); 
          
    }

    function display_action(dns_status, account_status) {

        if(dns_status.dns_status != 'true') {
			$('#loading').hide();
			$('#setup_incomplete').fadeIn()
            return console.log('Display DNS Setup Failed');
        }

	    if(account_status.known_user != true) {
			$('#loading').hide();
			$('#known_user').fadeIn()
			return console.log('Display Update IP Address');
        }

        if(account_status.no_sub != false) {
			$('#loading').hide();
			$('#no_sub').fadeIn()
            return console.log('Display Purchase Sub');
        }

        if(account_status.expired != false) {
			$('#loading').hide();
			$('#expired').fadeIn()
            return console.log('Display Account Expired');
        }

        if(account_status.sub_suspended != false) {
			$('#loading').hide();
			$('#sub_suspended').fadeIn()
            return console.log('Dispaly Account Suspended');
        }

		$('#loading').hide();
		$('#all_active').fadeIn()
        return console.log('Setup is Complete');
    }

    get_dns_status(dns_status_api, account_status_api);
  
