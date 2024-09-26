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
<<<<<<< HEAD
        'status',
        'remarks',
        'is_complete',
        'qa_signed',
        'client_signed'
=======
        'status'
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    ];
    protected $table = 'milestone';
    protected $guarded = [];
}
