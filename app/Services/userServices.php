<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class userServices {

    public function fetchAllUsers() {
        try {
            return User::all();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
