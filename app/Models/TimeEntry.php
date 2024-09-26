<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    use HasFactory;
    protected $fillable = ['project_id', 'employee_id', 'date', 'day', 'hours','reopen_reason_user','reopen_rejected_reason_pm','approved_rejected_date', 'is_ProjectManagers','is_Admin','status','approvedby_employee_id','rejectionReason','created_at'];

    public function project()
    {
        return $this->belongsTo(AddProjects::class, 'project_id');
    }
    public function employee()
    {
        return $this->belongsTo(employees::class, 'employee_id');
    }
    public function addworkesEmployees()
    {
        return $this->hasMany(addworkesEmployee::class, 'project_id', 'project_id');
    }
    public function addworkesEmployeesWithEmployee_id(){
        return $this->belongsTo(addworkesEmployee::class, 'employee_id');

    }
    public function addworkesEmployeesByEmployee()
    {
        return $this->hasMany(addworkesEmployee::class, 'employee_id', 'employee_id');
    }
    public function approvedByEmployee()
    {
        return $this->belongsTo(employees::class, 'approvedby_employee_id', 'id');
    }
}

