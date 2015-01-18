<?php

class DynDnsValidation extends Services\Validators\ValidatorBase
{
    public static $rules = [
        'hostname' => 'required|Regex:/^[a-z0-9-\.]+$/i|unique:dyn_dns,hostname'
    ];

    public static $message = [
    	'hostname.unique' => 'This hostname has been taken. Please choose another unique hostname or contact Customer Support at help.unotelly.com'
    ];
}