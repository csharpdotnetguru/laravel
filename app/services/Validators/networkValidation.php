<?php

class NetworkValidation extends Services\Validators\ValidatorBase
{
    public static $rules = [
        'network_name' => 'required|max:20|alpha_dash',
        'ip1' => 'required|max:255|min:1|numeric',
        'ip2' => 'required|max:255|numeric',
        'ip3' => 'required|max:255|numeric',
        'ip4' => 'required|max:255|numeric'
    ];
    public static $message = [
        'ip1.max' => 'IP box 1 cannot be greater than :max',
        'ip1.min' => 'IP box 1 must be greater than :min',
        'ip2.max' => 'IP box 2 cannot be greater than :max',
        'ip3.max' => 'IP box 3 cannot be greater than :max',
        'ip4.max' => 'IP box 4 cannot be greater than :max',
        'ip1.numeric' => 'IP box 1 must contain a number',
        'ip2.numeric' => 'IP box 2 must contain a number',
        'ip3.numeric' => 'IP box 3 must contain a number',
        'ip4.numeric' => 'IP box 4 must contain a number'
    ];
}