<?php

namespace App\Handlers;

use App\Services\userServices;
use Illuminate\Support\Facades\Log;

class userHandlers
{
    public function __construct(private userServices $userServices) {}

    public function fetchAllUsers() {
        try{
            return $this->userServices->fetchAllUsers();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }
    }
}
