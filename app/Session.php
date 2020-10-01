<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Model for inserting, selecting and deleting sessions rows
 * 
 * @author Alexandr Khurtin <axurtin.rep@gmail.com>
 * @version 1.0
 */

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
     * Method build url to payment form page
     * with current sessionID
     * 
     * @param string $host
     * @return string
     */
    
    private function buildURL(string $host) : string {
        $this->sessionID = Str::random(80);
        
        return 'http://' . $host . '/payments/card/form?sessionID=' . $this->sessionID;
    }
    
    /**
     * 
     * @param string $sessionID
     * @return Session | null
     */
    public function getOne(string $sessionID) {
        $result = $this->select('amount', 'target')
                ->where('sessionID', '=', $sessionID)
                ->get()
                ->first();
        return $result;
    }
    
    /**
     * 
     * @param string $sessionID
     * @return void
     */
    public function deleteOne(string $sessionID) : void {
        $this->where('sessionID', '=', $sessionID)->delete();
    }
}
