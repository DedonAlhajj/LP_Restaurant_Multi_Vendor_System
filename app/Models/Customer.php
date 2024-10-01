<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * الحقول القابلة للملء.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'password',
        'phone',
    ];

    /**
     * تحويل كلمة المرور إلى hash تلقائيًا عند حفظها.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}

