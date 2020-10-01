<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;

/**
 * Controller for rendering payment form page
 * 
 * @author Alexandr Khurtin <axurtin.rep@gmail.com>
 * @version 1.0
 */

class CardFormController extends Controller
{
    use \App\Traits\PeculiarValidator;
    
    /**
     *
     * @var Session
     */
    private $session;

    public function __construct() {
        $this->session = new Session();
    }
    
    /**
     * Rendering payment form page
     * 
     * @param Request $request
     * @return \Illuminate\View\View | \Illuminate\Http\RedirectResponse
     */
    
    public function index(Request $request) {
        $rules = [
            'sessionID' => 'required|string|max:80|min:80'
        ];
        $validator = $this->validator($request->all(), $rules);
        if ($validator) {
            return redirect()->route('cardResponse', ['status' => 'timeOut']);
        }
        // Check isset payment session
        $result = $this->session->getOne($request->sessionID);
        if (!$result) {
            return redirect()->route('cardResponse', ['status' => 'timeOut']);
        }
        
        $result['sessionID'] = $request->sessionID;
//        dd($result);
        return view('cardForm', [
            'data' => $result,
        ]);
    }
}
