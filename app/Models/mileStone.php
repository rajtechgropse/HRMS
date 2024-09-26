<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mileStone extends Model
{

    use HasFactory;
    protected $fillable = [
        'project_id',
        'name',
        'targetComplectionDate',
        'StartDate',
        'hours',
        'description',
        'status',
        'remarks',
        'is_complete',
        'qa_signed',
        'client_signed'
    ];
    protected $table = 'milestone';
    protected $guarded = [];
}
