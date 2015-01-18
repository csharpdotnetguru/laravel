<?php

class IpBan extends Eloquent{


    protected $table="ip_ban";
    protected $fillable = ['ip','status'];
    protected $primaryKey = 'ip';

}