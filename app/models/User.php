<?php

/**
 * An Eloquent Model: 'User'
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $companyname
 * @property string $email
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $postcode
 * @property string $country
 * @property string $phonenumber
 * @property string $password
 * @property string $authmodule
 * @property string $authdata
 * @property integer $currency
 * @property string $defaultgateway
 * @property float $credit
 * @property string $taxexempt
 * @property string $latefeeoveride
 * @property string $overideduenotices
 * @property string $separateinvoices
 * @property string $disableautocc
 * @property string $datecreated
 * @property string $notes
 * @property integer $billingcid
 * @property integer $securityqid
 * @property string $securityqans
 * @property integer $groupid
 * @property string $cardtype
 * @property string $cardlastfour
 * @property mixed $cardnum
 * @property mixed $startdate
 * @property mixed $expdate
 * @property mixed $issuenumber
 * @property string $bankname
 * @property string $banktype
 * @property mixed $bankcode
 * @property mixed $bankacct
 * @property string $gatewayid
 * @property \Carbon\Carbon $lastlogin
 * @property string $ip
 * @property string $host
 * @property string $status
 * @property string $language
 * @property string $pwresetkey
 * @property integer $pwresetexpiry
 * @property integer $emailoptout
 * @property integer $overrideautoclose
 * @property-read \Illuminate\Database\Eloquent\Collection|\DynPref[] $preferences
 * @property-read \Illuminate\Database\Eloquent\Collection|\DynPref[] $preference
 * @property-read \Illuminate\Database\Eloquent\Collection|\Network[] $networks
 * @property-read \UserHash $user_hash
 * @property-read \Illuminate\Database\Eloquent\Collection|\Sub[] $subs
 * @property-read \Free $free
 * @property string $activation_code
 * @property \Carbon\Carbon $activated_yet
 * @property string $activation_status
 */
class User extends Eloquent {

    protected $connection = 'unotelly_billing';
    protected $table = 'tblclients';
    protected $fillable = array(
	    	'firstname',
	    	'lastname',
	    	'email',
	    	'password',
	    	'address1',
	    	'city',
	    	'state',
	    	'country',
	    	'postcode',
	    	'datecreated',
	    	'phonenumber',
	    	'confirmed'
    	);
    protected $guarded = array('id');
    public $timestamps = false;

    public function favourite_channels()
    {
        return $this->belongsToMany('SupportedChannel', 'favourite_channels');
    }

}