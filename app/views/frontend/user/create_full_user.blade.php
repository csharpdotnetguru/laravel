<!DOCTYPE html>
<html lang="en">
<head>
<title>Sign in</title>
    {{  HTML::style('bootstrap/css/bootstrap.css')  }}

    {{  HTML::style('checkout/checkout.css')  }}

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>


    {{  HTML::script('bootstrap/js/bootstrap-alert.js')  }}
    {{  HTML::script('bootstrap/js/bootstrap-collapse.js')  }}



<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js" type="text/javascript"></script>

<?php
function get_countries(){
return array("AF" => "Afghanistan", "AL" => "Albania", "DZ" => "Algeria", "AS" => "American Samoa", "AD" => "Andorra", "AO" => "Angola", "AI" => "Anguilla", "AQ" => "Antarctica", "AG" => "Antigua and Barbuda", "AR" => "Argentina", "AM" => "Armenia", "AW" => "Aruba", "AU" => "Australia", "AT" => "Austria", "AZ" => "Azerbaijan", "BS" => "Bahamas", "BH" => "Bahrain", "BD" => "Bangladesh", "BB" => "Barbados", "BY" => "Belarus", "BE" => "Belgium", "BZ" => "Belize", "BJ" => "Benin", "BM" => "Bermuda", "BT" => "Bhutan", "BO" => "Bolivia", "BA" => "Bosnia and Herzegovina", "BW" => "Botswana", "BV" => "Bouvet Island", "BR" => "Brazil", "IO" => "British Indian Ocean Territory", "BN" => "Brunei Darussalam", "BG" => "Bulgaria", "BF" => "Burkina Faso", "BI" => "Burundi", "KH" => "Cambodia", "CM" => "Cameroon", "CA" => "Canada", "CV" => "Cape Verde", "KY" => "Cayman Islands", "CF" => "Central African Republic", "TD" => "Chad", "CL" => "Chile", "CN" => "China", "CX" => "Christmas Island", "CC" => "Cocos (Keeling) Islands", "CO" => "Colombia", "KM" => "Comoros", "CG" => "Congo", "CD" => "Congo, the Democratic Republic of the", "CK" => "Cook Islands", "CR" => "Costa Rica", "CI" => "Cote D'Ivoire", "HR" => "Croatia", "CU" => "Cuba", "CY" => "Cyprus", "CZ" => "Czech Republic", "DK" => "Denmark", "DJ" => "Djibouti", "DM" => "Dominica", "DO" => "Dominican Republic", "EC" => "Ecuador", "EG" => "Egypt", "SV" => "El Salvador", "GQ" => "Equatorial Guinea", "ER" => "Eritrea", "EE" => "Estonia", "ET" => "Ethiopia", "FK" => "Falkland Islands (Malvinas)", "FO" => "Faroe Islands", "FJ" => "Fiji", "FI" => "Finland", "FR" => "France", "GF" => "French Guiana", "PF" => "French Polynesia", "TF" => "French Southern Territories", "GA" => "Gabon", "GM" => "Gambia", "GE" => "Georgia", "DE" => "Germany", "GH" => "Ghana", "GI" => "Gibraltar", "GR" => "Greece", "GL" => "Greenland", "GD" => "Grenada", "GP" => "Guadeloupe", "GU" => "Guam", "GT" => "Guatemala", "GN" => "Guinea", "GW" => "Guinea-Bissau", "GY" => "Guyana", "HT" => "Haiti", "HM" => "Heard Island and Mcdonald Islands", "VA" => "Holy See (Vatican City State)", "HN" => "Honduras", "HK" => "Hong Kong", "HU" => "Hungary", "IS" => "Iceland", "IN" => "India", "ID" => "Indonesia", "IR" => "Iran, Islamic Republic of", "IQ" => "Iraq", "IE" => "Ireland", "IL" => "Israel", "IT" => "Italy", "JM" => "Jamaica", "JP" => "Japan", "JO" => "Jordan", "KZ" => "Kazakhstan", "KE" => "Kenya", "KI" => "Kiribati", "KP" => "Korea, Democratic People's Republic of", "KR" => "Korea, Republic of", "KW" => "Kuwait", "KG" => "Kyrgyzstan", "LA" => "Lao People's Democratic Republic", "LV" => "Latvia", "LB" => "Lebanon", "LS" => "Lesotho", "LR" => "Liberia", "LY" => "Libyan Arab Jamahiriya", "LI" => "Liechtenstein", "LT" => "Lithuania", "LU" => "Luxembourg", "MO" => "Macao", "MK" => "Macedonia, the Former Yugoslav Republic of", "MG" => "Madagascar", "MW" => "Malawi", "MY" => "Malaysia", "MV" => "Maldives", "ML" => "Mali", "MT" => "Malta", "MH" => "Marshall Islands", "MQ" => "Martinique", "MR" => "Mauritania", "MU" => "Mauritius", "YT" => "Mayotte", "MX" => "Mexico", "FM" => "Micronesia, Federated States of", "MD" => "Moldova, Republic of", "MC" => "Monaco", "MN" => "Mongolia", "MS" => "Montserrat", "MA" => "Morocco", "MZ" => "Mozambique", "MM" => "Myanmar", "NA" => "Namibia", "NR" => "Nauru", "NP" => "Nepal", "NL" => "Netherlands", "AN" => "Netherlands Antilles", "NC" => "New Caledonia", "NZ" => "New Zealand", "NI" => "Nicaragua", "NE" => "Niger", "NG" => "Nigeria", "NU" => "Niue", "NF" => "Norfolk Island", "MP" => "Northern Mariana Islands", "NO" => "Norway", "OM" => "Oman", "PK" => "Pakistan", "PW" => "Palau", "PS" => "Palestinian Territory, Occupied", "PA" => "Panama", "PG" => "Papua New Guinea", "PY" => "Paraguay", "PE" => "Peru", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PT" => "Portugal", "PR" => "Puerto Rico", "QA" => "Qatar", "RE" => "Reunion", "RO" => "Romania", "RU" => "Russian Federation", "RW" => "Rwanda", "SH" => "Saint Helena", "KN" => "Saint Kitts and Nevis", "LC" => "Saint Lucia", "PM" => "Saint Pierre and Miquelon", "VC" => "Saint Vincent and the Grenadines", "WS" => "Samoa", "SM" => "San Marino", "ST" => "Sao Tome and Principe", "SA" => "Saudi Arabia", "SN" => "Senegal", "CS" => "Serbia and Montenegro", "SC" => "Seychelles", "SL" => "Sierra Leone", "SG" => "Singapore", "SK" => "Slovakia", "SI" => "Slovenia", "SB" => "Solomon Islands", "SO" => "Somalia", "ZA" => "South Africa", "GS" => "South Georgia and the South Sandwich Islands", "ES" => "Spain", "LK" => "Sri Lanka", "SD" => "Sudan", "SR" => "Suriname", "SJ" => "Svalbard and Jan Mayen", "SZ" => "Swaziland", "SE" => "Sweden", "CH" => "Switzerland", "SY" => "Syrian Arab Republic", "TW" => "Taiwan, Province of China", "TJ" => "Tajikistan", "TZ" => "Tanzania, United Republic of", "TH" => "Thailand", "TL" => "Timor-Leste", "TG" => "Togo", "TK" => "Tokelau", "TO" => "Tonga", "TT" => "Trinidad and Tobago", "TN" => "Tunisia", "TR" => "Turkey", "TM" => "Turkmenistan", "TC" => "Turks and Caicos Islands", "TV" => "Tuvalu", "UG" => "Uganda", "UA" => "Ukraine", "AE" => "United Arab Emirates", "GB" => "United Kingdom", "US" => "United States", "UM" => "United States Minor Outlying Islands", "UY" => "Uruguay", "UZ" => "Uzbekistan", "VU" => "Vanuatu", "VE" => "Venezuela", "VN" => "Viet Nam", "VG" => "Virgin Islands, British", "VI" => "Virgin Islands, U.s.", "WF" => "Wallis and Futuna", "EH" => "Western Sahara", "YE" => "Yemen", "ZM" => "Zambia", "ZW" => "Zimbabwe" );
}
?>
<script>

jQuery(document).ready(function($){

		/*The country onchange starts here*/
		var orig_html;
		var orig_value;
		var state_value;

		var us_states = {Alberta: 'Alberta', "British Columbia": 'British Columbia', Ontario: 'Ontario',  Manitoba: 'Manitoba', 
		"New Brunswick": 'New Brunswick', "Newfoundland": 'Newfoundland', "Northwest Territories": 'Northwest Territories', 
		"Nova Scotia": 'Nova Scotia', "Nunavut": 'Nunavut', "Quebec": 'Quebec', "Saskatchewan": 'Saskatchewan', "Yukon Territory": 'Yukon Territory', "Prince Edward Island": 'Prince Edward Island'};
		var $el = $("#location-country");
		$el.data('oldval', $el.val());
		$el.change(function(){
		var $this = $(this);
		if(this.value=="CA" && $this.data('oldval')!="CA"){
		var str = '<select name="state" id="state">';
		orig_html = $("#state-div").html();
		orig_value = $("#state").val();
		for(var st in us_states){
		if(st == state_value)
		str += '<option value="'+st+'" selected="selected">'+us_states[st]+'</option>';
		else
		str += '<option value="'+st+'">'+us_states[st]+'</option>';
		}
		str += "</select>";
		$("#state-div").html(str);
		$this.data('oldval', $this.val());
		}
		else if($this.data('oldval')=="CA" && $this.val()!="CA"){
		state_value = $("#state").val();
		$("#state-div").html(orig_html);
		$("#state").val(orig_value);
		$this.data('oldval', $this.val());
		}
		});

		$("#checkout_register").validate();

});
</script>

<style>
		label.valid {
		  width: 24px;
		  height: 24px;
		  background: url(assets/img/valid.png) center center no-repeat;
		  display: inline-block;
		  text-indent: -9999px;
		}
		label.error {
			font-weight: bold;
			color: red;
			padding: 2px 8px;
			margin-top: 2px;
		}
</style>
</head>



<body>
  <div class="container">

@include('partials._notification')

	<h1 class="page-header"><img src=" {{ asset('checkout/check1.gif'); }}
"/>	</h1>
					
					
{{ Form::open(['route' => ['store_full_user'], 'method' => 'POST', 'id' => 'checkout_register', 'class'=> 'form-horizontal' ]) }}


  <fieldset>
  
<h4>New to UnoTelly? Register Below.</h4>
<br />  
    <div class="control-group">
      <label class="control-label" for="firstname">First Name</label>
      <div class="controls">
        <input type="text" name='firstname' class="required" id="firstname" value="{{ Input::old('firstname') }}">
        <p class="help-block">Enter your first name</p>
      </div>
    </div>	

    <div class="control-group">
      <label class="control-label" for="lastname">Last Name</label>
      <div class="controls">
        <input type="text" name='lastname' class="required" id="lastname" value="{{ Input::old('lastname') }}">
        <p class="help-block">Enter your last name</p>
      </div>
    </div>		
	
    <div class="control-group">
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="text" name='email' class="required email" id="email" value="@if (Session::get('email')){{ Session::get('email') }}@else{{ Input::old('email') }}@endif"> <!-- Removed redundant empty function call-->
        <p class="help-block">Enter your e-mail address</p>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="address1">Billing Address</label>
      <div class="controls">
        <input type="text" name='address1' class="required" id="address1" value="{{ Input::old('address1') }}">
        <p class="help-block">Enter your billing address</p>
      </div>
    </div>		

    <div class="control-group">
      <label class="control-label" for="input01">Country</label>
      <div class="controls">
		
		<select id="location-country" name="country">
		<option value="0">Choose country</option>
		<?php foreach(get_countries() as $country_key => $country_name): ?>
		<option class="required" value="<?php echo $country_key; ?>"><?php echo $country_name; ?></option>
		<?php endforeach; ?>
		</select>
		
        <p class="help-block">Enter your billing country</p>
      </div>
    </div>		



    <div class="control-group">
      <label class="control-label" for="state">Province/State</label>
      <div class="controls">

		<div id="state-div">
			<input id="state" type="text" name="state" class="required" value="{{ Input::old('state') }}"/>
		</div>
		
        <p class="help-block">Enter your State/Province</p>
      </div>
    </div>		

    <div class="control-group">
      <label class="control-label" for="city">City</label>
      <div class="controls">
        <input type="text" name='city' class="required" id="city" value="{{ Input::old('city') }}">
        <p class="help-block">Enter your billing city</p>
      </div>
    </div>			
	
    <div class="control-group">
      <label class="control-label" for="postcode">Zip/Postal Code</label>
      <div class="controls">
        <input type="text" name='postcode' class="required" id="postcode" value="{{ Input::old('postcode') }}">
        <p class="help-block">Enter your zip/postal code</p>
      </div>
    </div>	

<br />
<h4>Protect your information with a password</h4>
<br />
	
	<div class="control-group" id="password">
      <label class="control-label" for="password">Password:</label>
      <div class="controls">
        <input type="password" name='password' class="required" id="password" value="{{ Input::old('password') }}" >
        <p class="help-block">Your UnoTelly password.</p>
      </div>
    </div>	
	
	<div class="form-actions">
		<button type="submit" id='sign_up_submit' class="btn btn-primary">Register an UnoTelly account</button>
	</div>
  </fieldset>
</form>
  </div>
</body>

</html>