<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        $user = User::create($request->validated());

        auth()->login($user);

        $userDetail = new UserDetail([
            'user_id' => $user->id, // Set the user_id here
        ]);
    
        $userDetail->save();

        // After successful registration, set a success flash message
        session()->flash('success', 'Account successfully registered');

        // You can also return a redirect response to a specific page
        return redirect('/');
    }
}

