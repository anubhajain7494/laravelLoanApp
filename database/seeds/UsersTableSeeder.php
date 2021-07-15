<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        
        // Let's make sure everyone has the same password and 
        // let's hash it before the loop, or else our seeder 
        // will be too slow.
        $password = Hash::make('toptal');

        $users = [[
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => $password,
            'api_token' => str_random(60)
        ],
        [
            'name' => 'anubha',
            'email' => 'anubha@test.com',
            'password' => $password,
            'api_token' => str_random(60)
        ]];
        
        foreach($users as $user){
            User::create($user);
        }
    }
}
