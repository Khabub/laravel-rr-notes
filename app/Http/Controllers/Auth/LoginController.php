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
                'name' => ['The credentials you entered are incorrect']
            ]);
        }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('laravel_api_token')->plainTextToken
        ]); */




        // použít při api-web
            
        if (!auth()->attempt($request->only(['name', 'password']))) {
            throw ValidationException::withMessages([
                'input' => ['The credentials you entered are incorrect'],
                'inputCze' => ['Zadané přihlašovací údaje jsou nesprávné']
            ]);
        }
    }
}
