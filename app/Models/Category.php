<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'name_i18n',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'name_i18n' => 'array', // Automatically cast to array
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
