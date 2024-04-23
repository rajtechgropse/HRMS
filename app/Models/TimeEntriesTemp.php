<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEntriesTemp extends Model
{
    use HasFactory;
    protected $table = 'time_entries_temp';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'employee_id',
        'date',
        'day',
        'monday_hours',
        'tuesday_hours',
        'wednesday_hours',
        'thursday_hours',
        'friday_hours',
        'saturday_hours',
        'sunday_hours',
        'total_hours',
        'descriptions',
    ];
    public function project()
    {
        return $this->belongsTo(AddProjects::class, 'project_id');
    }
}
