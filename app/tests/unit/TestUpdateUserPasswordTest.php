<?php
use Codeception\Util\Stub;

class TestUpdateUserPasswordTest extends \Codeception\TestCase\Test
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
    public function testUpdateUserPassword()
    {
        $user_interface = app::make('UserRepositoryInterface');
        $test_params = Config::get('app.test_params_secondary'); //Switched to using secondary user
        $uid = $test_params['uid'];
        $user = $user_interface->find_user($uid);
        
        // 1) Check if correct user is fetched from database
        $this->assertEquals($user->id,$uid);

        // 2) Call update_user_profile with updated attributes
        $new_pass = 'newPass'.rand(0,999);
        $updated = $user_interface->update_full_user($user,$user->first_name, $user->lastname, $user->email, $user->city, $user->state, $user->postcode, $user->country,$user->address1,$new_pass);

        // 3) Check if it returned true
        $this->assertEquals($updated,true);

        // 4) Try to authenticate with new password
        $auth = $user_interface->auth($user->email,$new_pass);

        // 5) Check if Authentication took place
        $this->assertEquals($auth,$user);
    }

}