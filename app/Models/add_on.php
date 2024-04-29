<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class add_on extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id', 'Name', 'Description', 'Price'
    ];
    protected $table = 'add_on';
}
