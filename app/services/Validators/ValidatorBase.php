<?php namespace Services\Validators;


abstract class ValidatorBase
{

    public $errors;
    protected $attributes;

    public function __construct($attributes = null)
    {
        $this->attributes = $attributes ? : \Input::all();
    }


    public function fails($db = NULL)
    {
        return !$this->passes($db) ? true : false;
        // if ( ! $this->passes() )
        // {
        // 	return true;
        // }
        // else
        // {
        // 	return false;
        // }
    }

    public function passes($db = NULL)
    {

        $validation = \Validator::make($this->attributes, static::$rules, static::$message);

        if($db !== NULL) {
            $validation->getPresenceVerifier()->setConnection($db);
        }

        if ($validation->passes()) return true;

        $this->errors = $validation->messages();

        return false;
    }

}