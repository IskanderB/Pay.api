<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Session;
use App\Rules\Luhn;

class PaymentController extends Controller
{
    use \App\Traits\PeculiarValidator;
    
    const DEFAULT_COUNT_ROWS = 10;
    
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
            'amount' => 'required|numeric',
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
            'sessionID' => 'required|string|max:80|min:80|exists:sessions,sessionID',
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
    
    public function getAll(Request $request) {
        $this->payment = new Payment();
        $rules = [
            'begin_interval' => 'required|string|max:19',
            'end_interval' => 'string|max:19',
            'skip' => 'integer',
        ];
        $validator = $this->validator($request->all(), $rules);
        if ($validator) {
            return $validator;
        }

        $data = [
            'begin_interval' => $request->begin_interval,
            'end_interval' => $request->end_interval ?? date('Y-m-d h:i:s'),
            'skip' => $request->skip ?? 0,
        ];

        $result = $this->payment->getAll($data);
        
        if ($result) {
            if(count($result) > 10) {
                $skip = $data['skip'] + self::DEFAULT_COUNT_ROWS;
                $route = route('payments', [
                    'begin_interval' => $request->begin_interval,
                    'end_interval' => $request->end_interval,
                    'skip' => $skip,
                ]);
            }
            return response()->json([
                'data' => $result,
                'next' => $route ?? '',
            ], 200);
        }
        return response()->json([
                'data' => '',
            ], 404);
    }
}
