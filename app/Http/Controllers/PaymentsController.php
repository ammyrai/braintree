<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree_Transaction;
use Braintree_Gateway;

class PaymentsController extends Controller
{
      /*  Function is to process payment on braintree */
      public function make(Request $request)
      {
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $gateway = $this->brainConfig();
        $status = $gateway->transaction()->sale([
                        'amount' => '10.00',
                        'paymentMethodNonce' => $nonce,
                        'customerId' => 509424863,
                        'options' => [
                            'submitForSettlement' => True
                      ]
                    ]);
        return response()->json($status);
      }

      /* Function is to create a customer on braintree */
      public function createCustomer(){
        $gateway = $this->brainConfig();
        $result = $gateway->customer()->create([
            'firstName' => 'Aman',
            'lastName' => 'Dhiman',
            'email' => 'rooprai.aman@gmail.com'
          ]);

          $result->success;
          # true

          echo $result->customer->id;

      }

      /* Function is to save a card for a specific customer on braintree*/
      public function saveCard(){
          $gateway = $this->brainConfig();
          $result = $gateway->creditCard()->create([
                        'customerId' => 818752506,
                        'number' => '4000111111111115',
                        'expirationDate' => '06/22',
                        'cvv' => '100'
                    ]);
          echo "<pre>"; print_r($result);
          echo $result->creditCard->token;
      }

      /* Get saved cards from braintree */
      public function getSavedCard(){
        $gateway = $this->brainConfig();
        $creditCard = $gateway->creditCard()->find('hc3mw5');
        echo "<pre>"; print_r($creditCard);

      }

      /* Get a saved card's nonce to process a Payment */
      public function getPaymentToken()
      {
          $gateway = $this->brainConfig();
          $result = $gateway->paymentMethodNonce()->create('7s8q8f');
          echo $result->paymentMethodNonce->nonce;
      }

      /* Function to delete the saved card on braintree */
      public function deleteCard(){
        $gateway = $this->brainConfig();
        $msg = $gateway->creditCard()->delete('hc3mw5');
        echo "<pre>"; print_r($msg);
      }

      /* Config function to get the braintree config data to process all the apis on braintree gateway */
      public function brainConfig()
      {
        return new Braintree_Gateway([ 'environment' => env('BRAINTREE_ENV'),
                          'merchantId' => env('BRAINTREE_MERCHANT_ID'),
                          'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
                          'privateKey' => env('BRAINTREE_PRIVATE_KEY')
                      ]);
      }
}
