<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Session;
use App\Rules\Luhn;

class PaymentController extends Controller
{
    use \App\Traits\PeculiarValidator;
    
    private $payment;
    private $session;
        
    /**
     * This method validate request data, call model method 'create'
     * and send JSON response
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) : \Illuminate\Http\JsonResponse {
        $this->session = new Session();
        $rules = [
            'amount' => 'required|integer',
            'target' => 'required|string|max:255'
        ];
        $validator = $this->validator($request->all(), $rules);
        if ($validator) {
            return $validator;
        }
        
        $url = $request->getHttpHost();
        $result = $this->session->create($request->all(), $url);
        
        if ($result) {
            return response()->json([
                'data' => [
                    'pay_link' => $result
                ],
            ], 201);
        }
        return response()->json([
                'data' => '',
            ], 400);
        
    }
    
    public function create(Request $request) {
        $this->payment = new Payment();
        $rules = [
            'cardNumber' => ['required', 'string', 'max:19', 'min:19', new Luhn],
            'cardName' => 'max:255',
            'cardDate' => 'required|integer',
            'cardCvv' => 'required|string|max:4'
        ];
        $validator = $this->validator($request->all(), $rules);
        if ($validator) {
            return $validator;
        }
        
        $result = $this->payment->create($request->all());

        if ($result) {
            $url = route('cardResponse', ['status' => 1]);
            return response()->json([
                'url' => $url,
            ], 201);
        }
        $url = route('cardResponse', ['status' => 0]);
        return response()->json([
                'url' => $url,
            ], 400);
    }
}
