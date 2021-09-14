<?php

/**
 *
 * PHP version >= 7.0
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */


namespace App\Console\Commands;

/**
 * Class fetchMoreUser
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */

use App\Models\User;

use Exception;
use Illuminate\Console\Command;
use App\Util\FetchUser;


/**
 * Class deletePostsCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class FetchMoreUser extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "fetch:user {quantity=10}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Fetch more users.";

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fetchUser = new FetchUser;

        try {
            foreach ($fetchUser->getUsers($this->argument('quantity'))->results as $user) {
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

            $this->info("Successful saving of users");
        } catch (Exception $e) {
            $this->error("An error occurred");
        }
    }
}
