<?php

namespace App\Providers;

use App\Socialite\Linode;
use Illuminate\Support\ServiceProvider;

class SocialiteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootLinode();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function bootLinode()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'linode',
            function ($app) use ($socialite) {
                $config = $app['config']['services.linode'];
                return $socialite->buildProvider(Linode::class, $config);
            }
        );
    }
}
