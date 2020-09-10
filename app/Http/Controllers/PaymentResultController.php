<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentResultController extends Controller
{
    private $messages = [
        'Payment is not successfull!',
        'Payment is successfull!',
    ];
    public function index(Request $request) {
        return view('paymentResult', ['data' => [
            'message' => $this->messages[$request->status],
        ]]);
    }
}
