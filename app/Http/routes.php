<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::group(['prefix' => 'braintree'], function() {
        Route::get('checkout', [
            'as'   => 'braintree.checkout',
            'uses' => function() {
                $clientToken = Braintree\ClientToken::generate();
                return view('braintree.checkout', compact('clientToken'));
            }
        ]);

        Route::post('checkout', [
            'as'   => 'braintree.charge',
            'uses' => function() {
                return Braintree\Transaction::sale([
                    'amount' => (int) Request::input('amount'),
                    'paymentMethodNonce' => Request::input('payment_method_nonce')
                ]);
            }
        ]);
    });

    Route::group(['prefix' => 'stripe'], function() {
        Route::get('checkout', [
            'as'   => 'stripe.checkout',
            'uses' => function() {
                return view('stripe.checkout');
            }
        ]);

        Route::post('subscribe', [
            'as'   => 'stripe.subscribe',
            'uses' => function() {
                $user = App\User::find(1);
                $user->newSubscription('main', 'monthly')->create(Request::input('stripeToken'));
                return $user;
            }
        ]);

        Route::get('invoice', [
            'as'   => 'stripe.invoice',
            'uses' => function() {
                $user = App\User::find(1);
                $invoices = $user->invoices();
                return $user->downloadInvoice($invoices[0]->id, [
                    'vendor'  => 'Your Company',
                    'product' => 'Your Product',
                ]);
            }
        ]);
    });
});
