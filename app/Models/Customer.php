<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $gureded=[];
    
    public function orders()
    {
        return $this->hasMany(Customer::class, 'customer_id');
    }
    public function comments()
    {
        return $this->hasMany(Customer::class);
    }


}
