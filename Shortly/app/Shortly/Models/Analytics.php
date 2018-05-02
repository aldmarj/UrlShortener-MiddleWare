<?php

namespace Shortly\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Analytics extends Eloquent {
    public $table = 'analytics';
    public $fillable = ['ip_address', 'country', 'city', 'lat','lon', 'url_referral', 'device_info', 'link_id' ];
}