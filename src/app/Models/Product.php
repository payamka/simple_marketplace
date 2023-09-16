<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'title', 'price'];

    public function images(): hasMany
    {
        return $this->hasMany(Image::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shippingPrices(): HasMany
    {
        return $this->hasMany(ShippingPrice::class);
    }

    public function lastShippingPrice()
    {
        return $this->shippingPrices()->orderBy('id', 'desc')->first();
    }
}
