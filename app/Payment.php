<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Session;

class Payment extends Model
{
    public function create($data) {
        unset($data['cardName']);
        unset($data['cardDate']);
        unset($data['cardCvv']);
        $data['cardNumber'] = '*' . mb_strcut($data['cardNumber'], 15);
        $sessionID = $data['sessionID'];
        unset($data['sessionID']);
        
        $result = $this->insert($data);
        
        if($result) {
            $session = new Session();
            $session->deleteOne($sessionID);
            
            return $result;
        }
        return $result;
    }
    
    public function getAll($data) {
//        $data['end_interval'] = $data['end_interval'] ?? date('Y-m-d h:i:s');
//        $data['limit'] = $data['limit'] ?? 10;

        $result = $this->select()
                ->whereBetween('created_at', [$data['begin_interval'], $data['end_interval']])
                ->skip($data['skip'])
                ->take(10)
                ->get();
        
        if($result) {
            return $result->toArray();
        }
        return $result;
    }
}
