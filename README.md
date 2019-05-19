Braintree laravel

Braintree is a part of Paypal. It is one of the most secure and reliable payment method now in these days. Braintree accepts Mobile and web payment.

Installation

Install a package of braintree using the command

composer require braintree/braintree_php

add the below lines in your .env file.

BRAINTREE_ENV=sandbox
BRAINTREE_MERCHANT_ID=
BRAINTREE_PUBLIC_KEY=
BRAINTREE_PRIVATE_KEY=


To setup Braintree in Laravel, go to App/Providers/AppServiceProvider.php and add the following code to your boot() method
\Braintree_Configuration::environment(env('BRAINTREE_ENV'));
\Braintree_Configuration::environment(env('BRAINTREE_ENV'));
\Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
\Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
\Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));


Quick Start Example

In the routes/web.php add a new route for processing the payment
Route::get('/payment/make', 'PaymentsController@make')->name('payment.make');

In the Controllers create new make controller and add the code below:

use Braintree_Transaction;

public function make(Request $request)
{
    $payload = $request->input('payload', false);
    $nonce = $payload['nonce'];

    $status = Braintree_Transaction::sale([
	'amount' => '10.00',
	'paymentMethodNonce' => $nonce,
	'options' => [
	    'submitForSettlement' => True
	]
    ]);

    return response()->json($status);
}


For more information Fork the routes, views and controllers.

Happy Coding! :)
