<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\Contracts\AbstractRepository;

class OrderRepository extends AbstractRepository implements iOrderRepository
{
    protected $model = Order::class;
}
