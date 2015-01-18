<?php
use Codeception\Util\Stub;

class TestSessionCodeExpiredTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitGuy
    */
    protected $unitGuy;

    protected function _before()
    {
        $this->session_interface = App::make('SessionRepositoryInterface');
        $this->session_code_created_time_expired = time() - 120;
        $this->session_code_created_time_works = time();

    }

    protected function _after()
    {
    }

    // tests
    public function testSessionCodeHasExpired()
    {
        $has_expired_true = $this->session_interface->has_expired($this->session_code_created_time_expired);
        $this->assertTrue($has_expired_true, 'Session Code Expired');
        $has_expired_false = $this->session_interface->has_expired($this->session_code_created_time_works);
        $this->assertFalse($has_expired_false, 'Session Code Not Expired');
    }

}