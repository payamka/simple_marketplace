<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class ShoppingCart extends Model
{
    use HasFactory, HasCompositeKey;

    protected $fillable = ['product_id', 'user_id', 'quantity'];
    protected $primaryKey = ['product_id', 'user_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
