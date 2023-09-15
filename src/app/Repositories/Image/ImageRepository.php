<?php

namespace App\Repositories\Image;

use App\Models\Image;
use App\Repositories\Contracts\AbstractRepository;

class ImageRepository extends AbstractRepository implements iImageRepository
{
    protected $model = Image::class;
}
