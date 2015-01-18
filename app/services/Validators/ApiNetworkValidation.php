<?php

class ApiNetworkValidation extends Services\Validators\ValidatorBase
{
    public static $rules = [
        'ip_address' => 'ip'
    ];

    public static $message = [
    ];
}