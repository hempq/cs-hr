<?php

namespace App\Util;

use Illuminate\Support\Facades\Http;

class FetchUser
{

    public function getUsers(int $quantity = 10)
    {
        $response = Http::retry(3, 100)->get('https://randomuser.me/api/?results=' .  $quantity);
        $response->throw();
        return json_decode($response->getBody());
    }
}
