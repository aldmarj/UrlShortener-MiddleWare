<?php

namespace Shortly\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Link extends Eloquent {
    public $table = 'links';
    public $fillable = ['url', 'handle', 'name', 'domain','total_views', 'total_unique_views' ];
}

