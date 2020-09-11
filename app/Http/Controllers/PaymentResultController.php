<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentResultController extends Controller
{
    private $messages = [
        0 => 'Payment is not successfull!',
        1 => 'Payment is successfull!',
        'timeOut' => 'Payment session is time out, used or incorrect!',
    ];
    public function index(Request $request) {
        return view('paymentResult', ['data' => [
            'message' => $this->messages[$request->status],
        ]]);
    }
}
