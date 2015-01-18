<?php

/**
 * An Eloquent Model: 'UserHash'
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $user_hash
 * @property integer $api_calls
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \user $user
 * @method static \Illuminate\Database\Query\Builder|\UserHash whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserHash whereUserId($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserHash whereUserHash($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserHash whereApiCalls($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserHash whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\UserHash whereUpdatedAt($value) 
 */
class UserHash extends Eloquent
{
	/*
		id
		user_id unique
		user_hash key
		api_calls

	*/

	protected $table = 'client_hash';
	protected $fillable = ['api_calls', 'user_hash', 'user_id'];

	public function user()
	{
		$this->belongsTo('user');
	}

	/*
	Hash generation upon user creation
	Hash = md5(user_id, email, ip);
	*/

	public function prepare_hash($uid, $email, $ip_address)
	{
		return $user_hash = md5($uid . $email . $ip_address);
	}

	public function fetch_hash($uid) {
        $user_hash = $this->where('user_id', '=', $uid)->first();
        if(!is_null($user_hash)){
            return $user_hash->user_hash;
        }
	}

	public function get_ip_update_link($uid) {
		$user_hash = $this->fetch_hash($uid);
        if($user_hash!=NULL)
		return $ip_update_link = "http://www.unotelly.com/unodns/auto_auth/hash_update/updateip.php?user_hash=" . $user_hash;

        return "";
	}


	public function num_api_calls($uid)
	{
		$num_api_calls_obj = $this->where('user_id', '=', $uid)->first();
		return $num_api_calls_obj !== NULL 
			? $num_api_calls_obj->api_calls 
			: NULL;
	}

	/*
		is_under_api_limit
			checks to see if user current api calls is less than api limit
		params
			api_limit
			num_api_calls

	*/
	public function is_over_api_limit($uid, $api_limit)
	{
		if ( ( $num_api_calls = $this->num_api_calls($uid) ) !== NULL) 
		{
			return $num_api_calls > $api_limit 
				? TRUE	 
				: FALSE;
		}
		//fatal error; num_api_calls is null; log this
	}

	/*
		increment api_calls by 1
		@params
			uid
		@return 
			true/false
	*/

	public function incre_api_calls($uid)
	{


		$user_hash_obj = UserHash::where('user_id', '=', $uid)->first();

		if ($user_hash_obj === NULL) {
			return FALSE;
		}
		
		$user_hash_obj->api_calls = $user_hash_obj->api_calls +=1;

		if ( ! $user_hash_obj->save() )
		{
			$message = 'UserHash | incre_api_calls() | unable to save Model';
			throw new Exception($message); 
		}
		
		return TRUE;

	}

	/***
	Link to be called by cron to reset api per day 
	@params
		$passkey
	return true/false
	***/

	public function reset_api_calls()
	{
		if ( (DB::update('update client_hash set api_calls = ?', array('0')) ) )
		{
			return TRUE;
		}

		return FALSE;
	}
}