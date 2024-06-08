<?php

namespace App\Actions\Api\Auth;

use App\Actions\Action;
use App\Models\User;

class RegisterAction extends Action
{
    //TODO: Bikin unit test nya
    /**
     * Function to handle the registration of a new user
     *
     * @param array $data
     * @return void
     */
    public function handle(array $data): void
    {
        User::query()->create($data);
    }
}
