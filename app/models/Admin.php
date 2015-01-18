<?php
/**
 * Created by JetBrains PhpStorm.
 * 
 * User: Shavauhn
 * Date: 02/07/13
 * Time: 11:10 AM
 * To change this template use File | Settings | File Templates.
 *
 */

class Admin extends Eloquent{


    protected $table="admins";
    protected $guarded=['id'];
}