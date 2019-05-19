<h1>Braintree laravel</h1>

Braintree is a part of Paypal. It is one of the most secure and reliable payment method now in these days. Braintree accepts Mobile and web payment.

<h1>Installation</h1>

Install a package of braintree using the command

<pre>composer require braintree/braintree_php</pre>

add the below lines in your .env file.

<pre>BRAINTREE_ENV=sandbox
BRAINTREE_MERCHANT_ID=
BRAINTREE_PUBLIC_KEY=
BRAINTREE_PRIVATE_KEY=</pre>


To setup Braintree in Laravel, go to <b>App/Providers/AppServiceProvider.php</b> and add the following code to your <b>boot()</b> method
<pre>
\Braintree_Configuration::environment(env('BRAINTREE_ENV'));
\Braintree_Configuration::environment(env('BRAINTREE_ENV'));
\Braintree_Configuration::merchantId(env('BRAINTREE_MERCHANT_ID'));
\Braintree_Configuration::publicKey(env('BRAINTREE_PUBLIC_KEY'));
\Braintree_Configuration::privateKey(env('BRAINTREE_PRIVATE_KEY'));</pre>


<h1>Quick Start Example</h1>

In the <b>routes/web.php</b> add a new route for processing the payment

<pre>Route::get('/payment/make', 'PaymentsController@make')->name('payment.make');</pre>

In the Controllers create new make controller and add the code below:

<pre>
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
</pre>

<h3>For more information Fork the routes, views and controllers.</h3>

Happy Coding! :)
