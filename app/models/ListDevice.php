<?php

class ListDevice extends Eloquent{


    protected $table = "list_devices";
    protected $guarded = ['id'];
    protected $primaryKey = 'device_code';

    public function useful_tips_articles() {
    	return $this->belongsToMany('UsefulTipArticle', 'useful_tips_articles_rel', 'item_code', 'article_id');
    }

    public function supported_channels() {
    	return $this->belongsToMany('SupportedChannel', 'channel_device_rel', 'device_id', 'channel_code');
    }
}