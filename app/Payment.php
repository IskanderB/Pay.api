<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Session;

/**
 * Model for inserting and selecting payment rows
 *
 * @author Alexandr Khurtin <axurtin.rep@gmail.com>
 * @version 1.0
 */

class Payment extends Model
{
    /**
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data) : bool {
        unset($data['cardName']);
        unset($data['cardDate']);
        unset($data['cardCvv']);
        $data['cardNumber'] = '*' . mb_strcut($data['cardNumber'], 15);
        $sessionID = $data['sessionID'];
        unset($data['sessionID']);

        $result = $this->insert($data);

        return $this->deleteSession($result, $sessionID);

    }

    /**
     *
     * @param bool $result
     * @param string $sessionID
     * @return bool
     */

    private function deleteSession(bool $result, string $sessionID) : bool {
        if($result) {
            $session = new Session();
            $session->deleteOne($sessionID);
        }
        return $result;
    }

    /**
     *
     * @param array $data
     * @return array
     */

    public function getAll(array $data) : array {
        $result = $this->select()
                ->whereBetween('created_at', [$data['begin_interval'], $data['end_interval']])
                ->skip($data['skip'])
                ->take(10)
                ->get()
                ->toArray();
        return $result;
    }
}
