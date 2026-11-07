<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request ->validate([
            'name'=>['required', 'string', 'max:255'],
            'email'=>[
                'required',
                'string',
                'email',
                'max:255',
                'lowercase',
                'unique:users,email',
            ],
            
            'password'=>[
                'required',
                'string',
                'confirmed',
                Password::min(8)->letters()->numbers(),

            ],
            'role'=>['prohibited'],
            
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role='customer';
        $user->save();

        return redirect()
        ->route('home')
        ->with('success', 'Your customer account has been created. You can now log in.');
    }
}
