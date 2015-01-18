<?php
use Codeception\Util\Stub;

class TestFindPwHashTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitGuy
    */
    protected $unitGuy;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testPwHashFound()
    {
        $test_params = Config::get('app.test_params');
        $uid = $test_params['uid'];
        $expected_pw_hash = $test_params['password_hash'];
        $user_interface = app::make('UserRepositoryInterface');
        $pw_hash = $user_interface->find_pw_hash($uid);
        $this->assertEquals($expected_pw_hash, $pw_hash);
    }

}