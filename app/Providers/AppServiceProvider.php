<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Cashier::ignoreMigrations();
        VerifyEmail::toMailUsing( function ($notifiable){

            $verifyUrl = \URL::temporarySignedRoute(
                'verification.verify', Carbon::now()->addMinutes(60), ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
            );
            return (new MailMessage)->subject('Hello Welcome')->view('emails.verification.send', ['url' => $verifyUrl]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
