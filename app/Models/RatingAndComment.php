<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingAndComment extends Model
{
    use HasFactory;
    protected $table='order_ratings_and_comments';
    protected $gureded=[];

}
