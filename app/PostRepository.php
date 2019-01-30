<?php

namespace App;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository implements CacheableInterface {

    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "App\\Post";
    }
}