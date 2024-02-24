<?php

namespace App\Http\Requests\Auth;

use App\Models\Campuses;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class LoginRequest extends FormRequest
{
    protected $email_universityID;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if (filter_var($this->input('email_universityID'), FILTER_VALIDATE_EMAIL)) {
            // If the input is an email
            return [
                'email' => ['required', 'string', 'email', 'exists:users,email'],
                'password' => ['required', 'string'],
            ];
        } else {
            // If the input is a university ID
            return [
                'universityID' => ['required', 'digits:10', 'exists:users,universityID'],
                'password' => ['required', 'string'],
            ];
        }
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


    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $credentials = $this->only($this->email_universityID, 'password');
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        if (!Auth::attempt($this->only($this->email_universityID, 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                $this->email_universityID => trans('auth.failed'),
            ]);
        }

        $campusInactive = Campuses::where('campus', $user->campus)->where('status', 'INACTIVE')->first();

        $roleInactive = User::with('user_role.role')->whereHas('user_role', function ($q) {
            $q->whereRelation('role', 'status', 'INACTIVE');
        })->find($user->id);

        info($user->user_role);
        if ($user->status === 'INACTIVE' || $roleInactive || $campusInactive) {
            throw ValidationException::withMessages([
                $this->email_universityID => 'Your account is deactivated. Please contact support.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }

    protected function prepareForValidation()
    {
        $this->email_universityID = filter_var($this->input('email_universityID'), FILTER_VALIDATE_EMAIL) ? 'email' : 'universityID';
        $this->merge([$this->email_universityID => $this->input('email_universityID')]);
    }
}
