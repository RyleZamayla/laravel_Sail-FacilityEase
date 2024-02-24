<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        $email_universityID = session('email_universityID');
        return view('auth.reset-password', ['request' => $request], ['email_universityID' => $email_universityID]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $email_universityID = filter_var($request->input('email_universityID'), FILTER_VALIDATE_EMAIL ) ? 'email' : 'universityID';
        $request->merge([$email_universityID => $request->input('email_universityID')]);

        $messages = [
            'email.required' => 'Please input your Email or your University ID.',
            'universityID.required' => 'Please input your Email or your University ID.',
            'email.exists' => 'The Email you entered is not registered yet.',
            'universityID.exists' => 'The University ID you entered is not registered yet.',
        ];

        if (filter_var($request->input('email_universityID'), FILTER_VALIDATE_EMAIL)) {
            $request->validate([
                'token' => ['required'],
                'email' => ['required', 'email', 'exists:users,email'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ], $messages);
        } else {
            $request->validate([
                'token' => ['required'],
                'universityID' => ['required', 'string', 'exists:users,universityID'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ], $messages);
        }


        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only($email_universityID, 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only($email_universityID))
                            ->withErrors([$email_universityID => __($status)]);
    }
}
