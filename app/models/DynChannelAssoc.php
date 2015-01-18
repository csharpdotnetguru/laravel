<?php

    /**
 * An Eloquent Model: 'DynChannelAssoc'
 *
 * @property integer $id
 * @property integer $channel_id
 * @property integer $country_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \DynChannel $channel
 * @property-read \DynCountry $country
 */
class DynChannelAssoc extends Eloquent{
        protected $table="dyn_channel_assoc";
        protected $guarded=array();
        
        
        public function channel(){
            return $this->belongsTo('DynChannel',"channel_id");
        }
        public function country(){
            return $this->belongsTo('DynCountry','country_id');
        }

        // public function find_channel_options($channel_id)
        // {
        //     return $channel_options = $this->where('channel_id', '=', $channel_id)->get();
        // }
        
    }