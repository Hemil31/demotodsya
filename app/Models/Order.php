<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'order_id_with_qty',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'order_id_with_qty' => 'array', // Automatically cast to array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
