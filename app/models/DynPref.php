<?php
/**
 * An Eloquent Model: 'DynPref'
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $country_id
 * @property integer $channel_id
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 * @property-read \DynCountry $country
 * @property-read \DynChannel $channel
 */
class DynPref extends Eloquent{
    protected $table="dyn_pref";
    protected $guarded=array();
    
    public function country(){
        return $this->belongsTo('DynCountry','country_id');
        /*
            DynCountry is inside DynPref
            search DynPref.country_id with DynCountry.id
            
        */
    }
    public function channel(){
        return $this->belongsTo('DynChannel','channel_id');
        /*
            DynChannel is inside DynPref
            Search DynPref.channel_id with Dynchannel.id
        */
    }

    // public function find_dyn_pref($uid, $channel_id)
    // {
    //     return $dyn_pref = $this->where('user_id', '=', $uid)->where('channel_id', '=', $channel_id)->first();
    // }
    
}