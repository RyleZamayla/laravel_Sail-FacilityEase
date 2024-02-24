<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verify Your Email Address')
                ->greeting('Hello ' . $notifiable->name . ',')
                ->line('Thank you for using our system. To complete your registration, please verify your email address.')
                ->action('Verify Email Address', $url)
                ->lineIf($notifiable->provider, 'Please update your basic information before you proceed with other transactions.');
        });

        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return 'http://ustp-facility-ease.online/reset-password/'.$token;
        });
    }
}
