<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function showPasswordResetForm()
    {
        return view('auth.forgot-password');
    }

    public function sendPasswordResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', "Password Reset Link Sent.")
            : back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);

            


    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }
}
