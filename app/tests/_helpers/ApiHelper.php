<?php
namespace Codeception\Module;

// here you can define custom functions for ApiGuy 

class ApiHelper extends \Codeception\Module
{


	public function value_not_null_empty($key)
	{
        $response = $this->getModule('REST')->response;
        $array_resp = json_decode($response);

        \PHPUnit_Framework_Assert::assertNotNull($array_resp->$key);
        \PHPUnit_Framework_Assert::assertNotEmpty($array_resp->$key);

    }
}
