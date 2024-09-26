<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAllocatedToProject extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $project;
    public $allocationPercentage;
    public $startDate;
    public $endDate;

    public function __construct($employee, $project, $allocationPercentage, $startDate, $endDate)
    {
        $this->employee = $employee;
        $this->project = $project;
        $this->allocationPercentage = $allocationPercentage;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function build()
    {
        return $this->view('emails.user_allocated_to_project')
                    ->subject('New Project Allocation')
                    ->with([
                        'employee' => $this->employee,
                        'project' => $this->project,
                        'allocationPercentage' => $this->allocationPercentage,
                        'startDate' => $this->startDate,
                        'endDate' => $this->endDate,
                    ]);
    }
}
