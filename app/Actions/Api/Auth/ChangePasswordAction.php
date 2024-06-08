<?php

namespace App\Actions\Api\Auth;

use App\Actions\Action;
use Illuminate\Support\Facades\Auth;

class ChangePasswordAction extends Action
{
    public function handle(array $data): void
    {
        Auth::user()->update([
            'password' => bcrypt($data['new_password'])
        ]);
    }
}
