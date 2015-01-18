<?php

class SupportedChannel extends Eloquent
{

    protected $table = "supported_channels";
    protected $guarded = ['id'];
    protected $primaryKey = 'channel_code';

    public function useful_tips_articles()
    {
        return $this->belongsToMany('UsefulTipArticle', 'useful_tips_articles_rel', 'item_code', 'article_id');
    }

    public function supported_devices()
    {
        return $this->belongsToMany('ListDevice', 'channel_device_rel', 'channel_code', 'device_id');
    }

    public function is_favourited()
    {
        /*
         * TODO: Maybe I could get all favourite channels, cache them
         * and then check if that channel is in the user's favourites
         * preventing hundreds of queries, but how?
         */

        $favourite = FavouriteChannel::where('user_id', Authenticate::get_uid())->where('channel_id', $this->id)->first();
        return ($favourite) ? true : false;
    }

}