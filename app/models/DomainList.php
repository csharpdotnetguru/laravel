<?php

/**
 * An Eloquent Model: 'DomainList'
 *
 * @property integer $id
 * @property string $domain
 * @property string $type
 */
class DomainList extends Eloquent{
    protected $table="domain_list";
    protected $guarded=['id'];
}