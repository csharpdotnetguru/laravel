<?php
use Codeception\Util\Stub;

class TestUpdateUserProfileTest extends \Codeception\TestCase\Test
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
    public function testUpdateUserProfile()
    {
        $user_interface = app::make('UserRepositoryInterface');
        $test_params = Config::get('app.test_params_secondary'); //Switched to using secondary user
        $uid = $test_params['uid'];
        $user = $user_interface->find_user($uid);
        
        // 1) Check if correct user is fetched from database
        $this->assertEquals($user->id,$uid);

        // 2) Call update_user_profile with updated attributes
        $old_first_name = $user->firstname;
        $modified_first_name = $user->firstname . rand(0,9);
        $updated = $user_interface->update_full_user($user,$modified_first_name, $user->lastname, $user->email, $user->city, $user->state, $user->postcode, $user->country,$user->address1,null);

        // 3) Check if it returned true
        $this->assertEquals($updated,true);

        // 4) Fetch user again from the database
        $user = $user_interface->find_user($uid);

        // 5) Check if correct user if fetched from database
        $this->assertEquals($user->id,$uid);

        // 6) Check if changes took place
        $this->assertEquals($user->firstname,$modified_first_name);
    }

}