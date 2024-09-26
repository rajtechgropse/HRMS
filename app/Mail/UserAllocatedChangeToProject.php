<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAllocatedChangeToProject extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $project;
    public $newAllocationPercentage;
    public $oldAllocationPercentage; // New property for old allocation
    public $startdate;
    public $enddate;

    /**
     * Create a new message instance.
     *
     * @param $employee
     * @param $project
     * @param $newAllocationPercentage
     * @param $oldAllocationPercentage
     * @param $startdate
     * @param $enddate
     */
    public function __construct($employee, $project, $newAllocationPercentage, $oldAllocationPercentage, $startdate, $enddate)
    {
        $this->employee = $employee;
        $this->project = $project;
        $this->newAllocationPercentage = $newAllocationPercentage;
        $this->oldAllocationPercentage = $oldAllocationPercentage;
        $this->startdate = $startdate;
        $this->enddate = $enddate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.userAllocatedChangeToProject')
                    ->subject('Your Project Allocation Has Been Updated')
                    ->from('tms@techgropse.com', 'TMS Team') 
                    ->with([
                        'employeeName' => $this->employee->name,
                        'projectName' => $this->project->projectname,
                        'newAllocationPercentage' => $this->newAllocationPercentage,
                        'oldAllocationPercentage' => $this->oldAllocationPercentage,
                        'startdate' => $this->startdate,
                        'enddate' => $this->enddate,
                    ]);
    }
}
