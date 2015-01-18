<?php

/**
 * An Eloquent Model: 'Channel'
 *
 * @property integer $id
 * @property string $image_url
 * @property string $channel_url
 * @property string $description
 * @property string $type
 * @property boolean $display
 * @property string $competitor
 * @property string $premium
 * @property string $gold
 * @property integer $display_order
 * @property string $name
 * @property string $comment
 */
class Channel extends Eloquent{
    protected $guarded=['id'];
}