<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        /* $user = User::where('name', $request->name)->first();

        if (!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['The credentials you entered are incorrect']
            ]);
        } */


        // aby šlo get /auth/user, tím nahoře to nešlo
        if (!auth()->attempt($request->only(['name', 'password']))) {
            throw ValidationException::withMessages([
                'email' => ['The credentials you entered are incorrect']
            ]);
        }
    }
}
