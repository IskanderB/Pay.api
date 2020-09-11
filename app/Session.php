<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Session extends Model
{
    /**
     *
     * @var string
     */
    private $sessionID;
    /**
     * 
     * @param arry $data
     * @param string $host
     * @return string
     */
        
    public function create(array $data, string $host) : string {
        $url = $this->buildURL($host);
        $data['sessionID'] = $this->sessionID;
        
        $DBresponse = $this->insert($data);
        
        if (!$DBresponse) {
            return $DBresponse;
        }
        
        return $url;
    }
    
    /**
     * 
     * @param string $host
     * @return string
     */
    
    private function buildURL(string $host) : string {
        $this->sessionID = Str::random(80);
        
        return 'http://' . $host . '/payments/card/form?sessionID=' . $this->sessionID;
    }
    
    public function getOne($sessionID) {
        $result = $this->select('amount', 'target')
                ->where('sessionID', '=', $sessionID)
                ->get()
                ->first();
        if ($result) {
            $result->toArray();
        }
        return $result;
    }
    
    public function deleteOne($sessionID) {
        $this->where('sessionID', '=', $sessionID)->delete();
    }
}
