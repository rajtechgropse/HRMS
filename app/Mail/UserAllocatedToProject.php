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
<<<<<<< HEAD
    public $startDate;
    public $endDate;

    public function __construct($employee, $project, $allocationPercentage, $startDate, $endDate)
=======

    public function __construct($employee, $project, $allocationPercentage)
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    {
        $this->employee = $employee;
        $this->project = $project;
        $this->allocationPercentage = $allocationPercentage;
<<<<<<< HEAD
        $this->startDate = $startDate;
        $this->endDate = $endDate;
=======
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    }

    public function build()
    {
        return $this->view('emails.user_allocated_to_project')
                    ->subject('New Project Allocation')
                    ->with([
                        'employee' => $this->employee,
                        'project' => $this->project,
                        'allocationPercentage' => $this->allocationPercentage,
<<<<<<< HEAD
                        'startDate' => $this->startDate,
                        'endDate' => $this->endDate,
=======
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                    ]);
    }
}
