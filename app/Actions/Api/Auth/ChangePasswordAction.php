<?php

namespace App\Actions\Api\Auth;

use App\Actions\Action;
use Illuminate\Support\Facades\Auth;

class ChangePasswordAction extends Action
{
    // TODO: bikin unit test nya
    /**
     * Change the password of the authenticated user.
     *
     * @param array $data
     * @return void
     */
    public function handle(array $data): void
    {
        Auth::user()->update([
            'password' => bcrypt($data['new_password'])
        ]);
    }
}
