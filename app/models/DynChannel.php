<?php
/**
 * An Eloquent Model: 'DynChannel'
 *
 * @property integer $id
 * @property string $channel
 * @property string $name
 * @property string $icon_path
 * @property string $subtitle
 * @property string $description
 * @property integer $display_order
 * @property boolean $display
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \DynChannelAssoc $association
 */
class DynChannel extends Eloquent{
    protected $table="dyn_channel";
    protected $guarded=array();
    
    public function association(){
        return $this->hasOne('DynChannelAssoc','channel_id');
    }

    // public function find_active_dyn_channels()
    // {
    // 	return $active_dyn_channels = $this->where('display', '=', '1')->get();
    // }
    // 
    public function dyn_countries() {
     	return $this->belongsToMany('DynCountry', 'dyn_channel_assoc', 'channel_id', 'country_id');
    }
}
?>