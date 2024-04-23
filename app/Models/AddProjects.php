<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddProjects extends Model
{
    use HasFactory;
    protected $fillable = [
        'ProjectCompany', 'ProjectName', 'ProjectBudget', 'ProjectType',
        'ProjectManager', 'Csm', 'Contract', 'Tags', 'Milestone',
        'Address','Comments', 'timezone_offset', 'cilentname', 'cilentemail',
        'companyname', 'cilentphone', 'projectstartdate', 'status',
    ];
}
