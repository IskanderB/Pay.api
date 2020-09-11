<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;

class CardFormController extends Controller
{
    use \App\Traits\PeculiarValidator;
    
    private $session;

    public function __construct() {
        $this->session = new Session();
    }
    
    public function index(Request $request) {
        $rules = [
            'sessionID' => 'required|string|max:80|min:80'
        ];
        $validator = $this->validator($request->all(), $rules);
        if ($validator) {
            return redirect()->route('cardResponse', ['status' => 'timeOut']);
        }
        
        $result = $this->session->getOne($request->sessionID);
        if (!$result) {
            return redirect()->route('cardResponse', ['status' => 'timeOut']);
        }
        
        $result['sessionID'] = $request->sessionID;
        return view('cardForm', [
            'data' => $result,
        ]);
    }
}
