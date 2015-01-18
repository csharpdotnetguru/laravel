<?php

class UpdateCcRecaptcha extends Eloquent{


    protected $table="recaptcha_update_cc";
    protected $fillable = ['uid', 'ip'];
}