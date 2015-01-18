<?php

class UserValidation extends Services\Validators\ValidatorBase{
    public static $rules=[
        'email'=>'required|email|unique:tblclients,email',
        'firstname'=>'required:2',
        'password'=>'required|min:5'
    ];
    public static $message=[];
}