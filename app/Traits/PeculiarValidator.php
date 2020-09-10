<?php

namespace App\Traits;

trait PeculiarValidator {
    
    /**
     * 
     * @param array $data
     * @param array $rules
     * @return boolean|\Illuminate\Http\JsonResponse
     */
    private function validator($data, $rules) {
        $validator = \Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
            ], 400);
        }
        return false;
    }
}


