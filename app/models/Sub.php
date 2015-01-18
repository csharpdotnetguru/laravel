<?php

/**
 * An Eloquent Model: 'Sub'
 *
 * @property integer $id
 * @property integer $clientid
 * @property integer $productid
 * @property string $productType
 * @property integer $productLength
 * @property integer $startTime
 * @property integer $endTime
 * @property string $status
 * @property string $notes
 */
class Sub extends Eloquent {
	
	protected $table = 'paidUsers';
	protected $guarded = [];

	public function user()
	{
		return $this->belongs('User');
	}
}