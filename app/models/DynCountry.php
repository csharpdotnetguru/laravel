<?php
/**
 * An Eloquent Model: 'DynCountry'
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \DynChannelAssoc $association
 */
class DynCountry extends Eloquent{
    protected $table="dyn_country";
    protected $guarded=array();
    
    public function association(){
        return $this->hasOne('DynChannelAssoc','country_id');
    }
}