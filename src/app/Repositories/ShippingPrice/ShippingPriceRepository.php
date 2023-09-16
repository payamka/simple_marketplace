<?php

namespace App\Repositories\ShippingPrice;

use App\Models\ShippingPrice;
use App\Repositories\Contracts\AbstractRepository;

class ShippingPriceRepository extends AbstractRepository implements iShippingPriceRepository
{
    protected $model = ShippingPrice::class;
}
