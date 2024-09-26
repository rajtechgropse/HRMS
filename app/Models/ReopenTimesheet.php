<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReopenTimesheet extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'reopen_timesheets';

    // Specify which attributes should be mass assignable
    protected $fillable = [
        'timesheet_id',
        'project_id',
        'employee_id',
        'date',
        'day',
        'reopen_reason_user',
        // 'is_ProjectManagers',
        'status',
        'approved_by_employee_id',
        'rejection_reason',
        'monday_hours',
        'tuesday_hours',
        'wednesday_hours',
        'thursday_hours',
        'friday_hours',
        'saturday_hours',
        'sunday_hours',
        'total_hours',
        'descriptions'
    ];

    // Optionally, you can define relationships and other model-specific methods here
}
