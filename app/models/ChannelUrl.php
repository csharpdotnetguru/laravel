<?php

/**
 * An Eloquent Model: 'ChannelUrl'
 *
 * @property integer $id
 * @property integer $dyn_channel_assoc_id
 * @property integer $channel_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ChannelUrl extends Eloquent{
    protected $table="channel_urls";
    protected $guarded=['id'];
}