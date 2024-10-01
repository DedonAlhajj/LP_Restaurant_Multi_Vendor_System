<?php

namespace App\Models;

use App\Models\OrderItem;
use App\Models\Restaurant;
use App\Models\Subcategory;
use App\Models\RatingAndComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FoodItem extends Model
{
    use HasFactory;
    protected $gureded=[];
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function ratingsAndComments()
    {
        return $this->hasMany(RatingAndComment::class);
    }
}
