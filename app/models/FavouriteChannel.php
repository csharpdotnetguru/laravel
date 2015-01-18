<?php

class FavouriteChannel extends Eloquent
{
    protected $table = 'favourite_channels';
    public $timestamps = true;
    protected $softDelete = false;

    protected $fillable = array('channel_id', 'user_id');
    protected $guarded = array('id', 'timestamps');

    public function user()
    {
        $this->belongsTo('User');
    }

    public function channel()
    {
        $this->hasOne('SupportedChannel');
    }
}