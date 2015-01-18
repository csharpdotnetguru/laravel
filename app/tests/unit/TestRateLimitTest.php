<?php

class TestRateLimitTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->rate_limit = app::make('RateLimitRepositoryInterface');
        $this->uri = 'api/public/v1/unitTest';
    }

    protected function tearDown()
    {
        //$this->rate_limit->redis->flushall();
    }

    // tests
    public function testRlApiLoginBlockFalseIfUnderLimit()
    {
        
        $ip = '1.2.3.4';
        $email = 'test@test.com';
        $this->rate_limit->api_login_failure_incr($ip, $email);
        $this->rate_limit->api_login_failure_incr($ip, $email);
        $data = $this->rate_limit->api_login_block($ip, 3, 3600);
        $this->assertEquals(FALSE, $data);
    }

    public function testRlApiLoginBlockTrueOverLimit() {
        $ip = '1.2.3.4';
        $email = 'test@test.com';

        $this->rate_limit->api_login_failure_incr($ip, $email);
        $this->rate_limit->api_login_failure_incr($ip, $email);
        $this->rate_limit->api_login_failure_incr($ip, $email);
        $this->rate_limit->api_login_failure_incr($ip, $email);

        $data = $this->rate_limit->api_login_block($ip, 3, 3600);
        
        $this->assertArrayHasKey('failures', $data);
        $this->assertArrayHasKey('ttl', $data);
        $this->assertNotEquals(FALSE, $data);
    }

    public function testRlClearApiLoginBlockOk() {
        $ip = '1.2.3.4';
        $email = 'test@test.com';
        $this->rate_limit->api_login_failure_incr($ip, $email);
        $this->rate_limit->api_login_failure_incr($ip, $email);
        $this->rate_limit->api_login_failure_incr($ip, $email);  
        $this->rate_limit->api_login_failure_incr($ip, $email);
        $this->rate_limit->api_login_faliure_clear($ip);
        $data = $this->rate_limit->api_login_block($ip, 3, 3600);
        $this->assertEquals(FALSE, $data);       
    }

    public function testRlApiPublicBlockUnderLimit() {
        $ip = '1.2.3.4';
        $max_per_interval = 5;
        $interval = 10;
        $i = 0;

        while($i < $max_per_interval - 1) {
            $this->rate_limit->api_public_incr($ip, $this->uri);
            $i++;
        }

        $data = $this->rate_limit->api_public_block($ip, $this->uri, $max_per_interval, $interval);
        $this->assertEquals(FALSE, $data);
    }

    public function testRlApiPublicBlockOverLimit() {
        $ip = '1.2.3.4';
        $max_per_interval = 5;
        $interval = 10;
        $i = 0;

        while($i < $max_per_interval + 1) {
             $this->rate_limit->api_public_incr($ip, $this->uri);
             $i++;
        }

        $data = $this->rate_limit->api_public_block($ip, $this->uri, $max_per_interval, $interval);
        $this->assertArrayHasKey('ip', $data);
        $this->assertArrayHasKey('count', $data);
        $this->assertArrayHasKey('ttl', $data);
        $this->assertNotEquals(FALSE, $data);    
    }

    public function testRlApiPublicClearBlock() {
        $ip = '1.2.3.4';
        $max_per_interval = 5;
        $interval = 10;
        $i = 0;

        $i = 0;

        while($i < $max_per_interval + 99) {
             $this->rate_limit->api_public_incr($ip, $this->uri);
             $i++;
        }

        $this->rate_limit->api_public_block_clear($ip, $this->uri);
        $data = $this->rate_limit->api_public_block($ip, $this->uri, $max_per_interval, $interval);
        $this->assertEquals(FALSE, $data);
    }
}