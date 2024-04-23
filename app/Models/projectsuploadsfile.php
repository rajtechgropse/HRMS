<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectsuploadsfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'category',
        'contract',

    ];
    protected $table = 'projectsuploadsfile';
    protected $guarded = [];
}
