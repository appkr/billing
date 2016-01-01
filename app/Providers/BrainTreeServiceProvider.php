<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BrainTreeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Braintree\Configuration::environment('sandbox');
        \Braintree\Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
        \Braintree\Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
        \Braintree\Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
