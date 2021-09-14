<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Util\FetchUser;

class UserTableSeeder extends Seeder
{

    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fetchUser = new FetchUser;

        foreach ($fetchUser->getUsers()->results as $user) {
            $newUser = new User;
            $newUser->name = $user->name->first . " " . $user->name->last;
            $newUser->age = $user->dob->age;
            $newUser->city = $user->location->city;
            $newUser->country = $user->location->state;
            $newUser->email = $user->email;
            $newUser->salt = $user->login->salt;
            $newUser->password = $user->login->sha256;
            $newUser->picture = $user->picture->large;
            $newUser->save();
        }
    }
}
