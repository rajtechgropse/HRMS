<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PendingTimesheetReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $employeeName;
    public $employeeEmail;
    public $projectName;
    public $pendingTimesheetDates;

    public function __construct($employeeName, $employeeEmail, $projectName, $pendingTimesheetDates)
    {
        $this->employeeName = $employeeName;
        $this->employeeEmail = $employeeEmail;
        $this->projectName = $projectName;
        $this->pendingTimesheetDates = $pendingTimesheetDates;
    }

    public function build()
    {
        return $this->view('emails.pending_timesheet_reminder')
                    ->subject('Pending Timesheets Reminder');
    }
}
