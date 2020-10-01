<?php

namespace App\Traits;

/**
 * Custom validator use usial Validators methods
 * in special combination
 */

trait PeculiarValidator {

    /**
     *
     * @param array $data
     * @param array $rules
     * @return boolean|\Illuminate\Http\JsonResponse
     */
    private function validator(array $data, array $rules) {
        $validator = \Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'data' => $validator->errors(),
            ], 422);
        }
        return false;
    }
}
