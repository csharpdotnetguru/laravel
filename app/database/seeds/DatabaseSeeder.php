<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
     
	 public function run(){
        $this->call('UserSeeder');


        //$this->command->info('User table seeded!');
    }
}


class UserSeeder extends Seeder{
    public function run(){

        // TODO: this should be better adapted to BillingDB.API AuthAPI
        $salt_password = 'a7ba018e25468c07fbe41285c7aa0c1b:EvGwB'; // = bus2012;
        $salt_password2 = 'a7ba018e25468c07fbe41285c7aa0c1b:EvGwB'; // = bus2012;
        $salt_password3 = 'c5941ae4b0f78017f05a78b943128e6a:DpGeu'; // = test123

     
        User::create(array(
        'id'=>'421344',
        'firstname'=>"Anakin",
        'lastname'=>'Skywalker',
        'email'=>'anakin.skywalker@unotelly.com',
        'password'=>$salt_password3,
        'address1'=>'na',
        'country'=>'AF',
        'city'=>'na',
        'postcode'=>'na',
        'state'=>'na'
        ));
    }
}
