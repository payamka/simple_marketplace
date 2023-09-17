<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'title', 'price'];
    protected $with = ['lastShippingPrice'];

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
        return $this->hasMany(ShippingPrice::class)->orderBy('id', 'DESC')->take(1);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn(int $value) => $value + (isset($this->lastShippingPrice[0]) ? $this->lastShippingPrice[0]->price : 0),
        );
    }
}
