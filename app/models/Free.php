<?php


/**
 * An Eloquent Model: 'Free'
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $regTime
 * @property integer $trialLength
 * @property integer $endTime
 * @property integer $status
 */
class Free extends Eloquent {
	protected $table = 'free';
	protected $guarded = [];

	public function user()
	{
		$this->belongs('User');
	}
}