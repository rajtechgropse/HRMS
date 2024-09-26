<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // The table associated with the model.
    protected $table = 'countries';

    // The attributes that are mass assignable.
    protected $fillable = [
        'country_name',
        'currency_code',
        'currency_name',
        'currency_sign',
        'countrycode',
    ];

    // If you want to explicitly set the primary key (optional).
    protected $primaryKey = 'id';

    // If the primary key is not an incrementing integer.
    public $incrementing = true;

    // If you want to disable timestamps, set this to false.
    public $timestamps = true;
}
