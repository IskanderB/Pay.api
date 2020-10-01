<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller for rendering page is contented payment result
 * 
 * @author Alexandr Khurtin <axurtin.rep@gmail.com>
 * @version 1.0
 */

class PaymentResultController extends Controller
{
    /**
     *
     * @var array 
     */
    private $messages = [
        0 => 'Payment is not successfull!',
        1 => 'Payment is successfull!',
        'timeOut' => 'Payment session is time out, used or incorrect!',
    ];
    
    /**
     * Render page with payment result
     * 
     * @param Request $request
     * @return \Illuminate\View\View
     */
    
    public function index(Request $request) : \Illuminate\View\View {
        return view('paymentResult', ['data' => [
            'message' => $this->messages[$request->status],
        ]]);
    }
}
