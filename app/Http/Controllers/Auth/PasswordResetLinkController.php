<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $email_universityID = filter_var($request->input('email_universityID'), FILTER_VALIDATE_EMAIL) ? 'email' : 'universityID';
        $request->merge([$email_universityID => $request->input('email_universityID')]);

        $messages = [
            'email.required' => 'Please input your Email or your University ID.',
            'universityID.required' => 'Please input your Email or your University ID.',
            'email.exists' => 'The Email you entered is not registered yet.',
            'universityID.exists' => 'The University ID you entered is not registered yet.',
        ];

        if (filter_var($request->input('email_universityID'), FILTER_VALIDATE_EMAIL)) {
            $request->validate([
                'email' => ['required', 'email', 'exists:users,email'],
            ], $messages);
        } else {
            $request->validate([
                'universityID' => ['required', 'string', 'exists:users,universityID'],
            ], $messages);
        }

        session(['email_universityID' => $request->input('email_universityID')]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only($email_universityID)
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only($email_universityID))
            ->withErrors([$email_universityID => __($status)]);
    }

    public function messages()
    {
        if (filter_var($this->input('email_universityID'), FILTER_VALIDATE_EMAIL)) {
            // If the input is an email
            return [
                'email.required' => 'Email field is required when University Field is not present.',
                'email.exists' => 'Your email has not been registered.',
                // Add other custom messages as needed
            ];
        } else {
            // If the input is a university ID
            return [
                'universityID.required' => 'University ID field is required when Email is not present.',
                'universityID.digits' => 'University ID must be a number of exactly 10 digits long.',
                'universityID.exists' => 'Your University ID has not been registered.',
                // Add other custom messages as needed
            ];
        }
    }
}
