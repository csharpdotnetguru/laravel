<?php
use Codeception\Util\Stub;

class TestFindNetworkTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitGuy
    */
    protected $unitGuy;

    protected function _before()
    {
        $this->network_interface = App::make('NetworkRepositoryInterface');
        $this->sub_interface = App::make('SubRepositoryInterface');
        $this->ip = '1.2.3.4';
        $this->ip_known = '127.0.0.1';
        $this->ip_unknown = '93.2.123.42';
        $this->uids = ['565303', '324341', '34132', '23'];
        $this->uids_no_sub = ['222565303', '23324341', '21334132', '34234523'];
        $this->subs_status = [

            0 => [
                'account_status' => 'inactive',
                'expiry_status' => FALSE
            ],
            1 => [
                'account_status' => 'inactive',
                'expiry_status' => TRUE
            ],
            2 => [
                'account_status' => 'active',
                'expiry_status' => FALSE
            ],
            3 => [
                'account_status' => 'active',
                'expiry_status' => TRUE
            ]
        ];
        $this->good_array = [
            'account_status' => 'active',
            'expiry_status' => 'active'
        ];

        $this->subs_all_expired = [
            0 => [
                'endTime' => 1
            ],
            1 => [
                'endTime' => 324
            ],
            2 => [
                'endTime' => 342454
            ]
        ];

        $this->subs_no_expire = [
            0 => [
                'endTime' => 1
            ],
            1 => [
                'endTime' => 324
            ],
            2 => [
                'endTime' => 1577836800
            ]
        ];    


        $this->subs_no_suspend = [
            0 => [
                'status' => 'inactive'
            ],
            1 => [
                'status' => 'active'
            ],
            2 => [
                'status' => 'inactive'
            ]
        ];

        $this->subs_all_suspended = [
            0 => [
                'status' => 'inactive'
            ],
            1 => [
                'status' => 'inactive'
            ],
            2 => [
                'status' => 'inactive'
            ]
        ];   


    }

    protected function _after()
    {
    }

   // tests
    public function testFindUidsByIp()
    {
        $uids = $this->network_interface->find_uids_by_ip($this->ip);
        $count = count($uids);
        $this->assertGreaterThanOrEqual(1, $count);
        $this->assertNotEquals(FALSE, $uids);

    }


    public function testFindSubsByUidsYesSub()
    {
        $subs = $this->sub_interface->find_subs_by_uids($this->uids);
        $count = count($subs);
        $this->assertGreaterThanOrEqual(1, $count);
        $this->assertNotEquals(FALSE, $subs);
    }

    public function testFindSubsByUidsNoSub()
    {
        $subs = $this->sub_interface->find_subs_by_uids($this->uids_no_sub);
        $this->assertEquals(FALSE, $subs);
    }


    public function testAreSubsExpiredFalse()
    {
        $result = $this->sub_interface->are_subs_expired($this->subs_no_expire);
        $this->assertEquals(FALSE, $result);
    }


    public function testAreSubsExpiredTrue()
    {
        $result = $this->sub_interface->are_subs_expired($this->subs_all_expired);
        $this->assertEquals(TRUE, $result);
    }


    public function testAreSubsSuspendedFalse()
    {
        $result = $this->sub_interface->are_subs_suspended($this->subs_no_suspend);
        $this->assertEquals(FALSE, $result);
    }


    public function testAreSubsSuspendedTrue()
    {
        $result = $this->sub_interface->are_subs_suspended($this->subs_all_suspended);
        $this->assertEquals(TRUE, $result);
    }


    public function testIsKnownUserOk()
    {
        $result = $this->network_interface->is_known_user($this->ip_known);
        $this->assertNotEquals(FALSE, $result);
    }

    public function testIsKnownUserNotOk()
    {
        $result = $this->network_interface->is_known_user($this->ip_unknown);
        $this->assertEquals(FALSE, $result);
    }
}