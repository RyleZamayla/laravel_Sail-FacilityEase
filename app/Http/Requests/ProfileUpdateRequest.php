<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $userIdBeingUpdated = $this->route('userId');

        return [
            'img' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'imgSvg' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'fName' => ['required', 'max:255', 'regex:/^[A-Za-zñÑ\s]+$/'],
            'mName' => ['nullable', 'max:255', 'regex:/^[A-Za-zñÑ\s]+$/'],
            'lName' => ['required', 'max:255', 'regex:/^[A-Za-zñÑ\s]+$/'],

            'universityID' => ['required', Rule::unique(User::class)->ignore($userIdBeingUpdated ?? $this->user()->id)],
            'cNumber' => ['nullable', 'digits:11'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($userIdBeingUpdated ?? $this->user()->id)],
        ];
    }

    public function messages()
    {
        return [
            'imgSvg.image' => 'The file must be an image.',
            'imgSvg.mimes' => 'The file must be a file of type: :values.',
            'imgSvg.max' => 'The image may not be greater than :max kilobytes.',
            'img.image' => 'The file must be an image.',
            'img.mimes' => 'The file must be a file of type: :values.',
            'img.max' => 'The image may not be greater than :max kilobytes.',
            'fName.required' => 'This field is required.',
            'lName.required' => 'This field is required.',
            'fName.regex' => 'This field cannot be numeric.',
            'mName.regex' => 'This field cannot be numeric.',
            'lName.regex' => 'This field cannot be numeric.',
            'orgPosition.regex' => 'This field cannot be numeric.',
            'universityID.required' => 'This field is required.',
            'campus.required' => 'This field is required.',
            'college.required' => 'This field is required.',
            'organization.required' => 'This field is required.',
            'orgPosition.required' => 'This field is required.',
            'universityID.digits' => 'The University ID must be of exactly 10 digits long.',
            'cNumber.digits' => 'The Contact number must be of exactly 11 digits long.',
            'universityID.unique' => 'The University ID has already been taken.',
            'email.required' => 'This field is required.',
            'email.email' => 'The Email must be a valid email address.',
            'email.unique' => 'The Email has already been taken.',
            'password.required' => 'This field is required.',
            'password.confirmed' => 'The Password confirmation does not match.',
        ];
    }
}
