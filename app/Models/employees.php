<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
    use HasFactory;
    protected $fillable = [
        'empId',
        'emergencycontact',
        'pannumber',
        'name',
        'currentaddress',
        'trainingcompletion',
        'department',
        'permanentaddress',
        'comnpanyexperience',
        'designation',
        'city',
        'employeestatus',
        'reportingmanager',
        'dob',
        'lastworkingday',
        'officialemail',
        'joiningdate',
        'personalemail',
        'higestqualification',
        'contactdetails',
        'aadharnumber',
    ];
    public static function getDepartmentName($index)
    {
        $departments = ["Delivery", "Marketing", "Admin", "HR", "Business"];
        return isset($departments[$index - 1]) ? $departments[$index - 1] : null;
    }
}
