<?php

/**
 * An Eloquent Model: 'DynDns'
 *
 * @property integer $id
 * @property integer $uid
 * @property string $hostname
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class DynDns extends Eloquent
{
	protected $guarded = [];
	
}