<?php

namespace App\Repositories\Image;

interface iImageRepository
{
    public function saveMany($model, $items);
}
