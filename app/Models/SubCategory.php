<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class SubCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'name_i18n',
        'image',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'name_i18n' => 'array', // Automatically cast to array
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageAttribute($value)
    {
        return asset('storage/sub-category/' . ($value ?? 'demo.png'));
    }
}
