<?php

class PaidUser extends Eloquent {
	
	protected $table = 'paidUsers';
	protected $fillable = ['clientid', 'productid', 'productType', 'productLength', 'startTime', 'endTime', 'status', 'pkg_uniq_id'];



}