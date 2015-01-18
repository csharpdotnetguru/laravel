<?php

class TestUserAuthTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->user_interface = app::make('UserRepositoryInterface');

        $this->test_params = Config::get('app.test_params');

        $this->data = [
            'user_hash' => $this->test_params['user_hash'],
            'uid' => $this->test_params['uid'],
        ];
    }

    protected function tearDown()
    {
        //$this->rate_limit->redis->flushall();
    }

    // tests
    public function testUidUserHashAuthOk()
    {
        $uid = $this->data['uid'];
        $user_hash = $this->data['user_hash'];
        $result = $this->user_interface->uid_user_hash_auth($uid, $user_hash);
        $this->assertTrue($result);
    }


    public function testUidUserHashAuthFail()
    {
        $uid = $this->data['uid'];
        $user_hash = '123123213';
        $result = $this->user_interface->uid_user_hash_auth($uid, $user_hash);
        $this->assertEquals(FALSE, $result);
    }
}