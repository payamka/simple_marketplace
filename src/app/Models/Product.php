<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'price'];

    public function images(): hasMany
    {
        return $this->hasMany(Image::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
