<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function create($data) {
//        $data['cardDate'] = (string)$data['cardMonth'] . (string)$data['cardYear'];
//        unset($data['cardMonth']);
//        unset($data['cardYear']);
        
        return $this->insert($data);
    }
}
