<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\FoodItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RatingAndComment extends Model
{
    use HasFactory;
    protected $table='order_ratings_and_comments';
    protected $gureded=[];
    public function foodItem()
    {
        return $this->belongsTo(FoodItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
