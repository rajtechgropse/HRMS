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
<<<<<<< HEAD
                    ->subject('Pending Timesheets Reminder');
=======
                    ->with([
                        'employeeName' => $this->employeeName,
                        'projectName' => $this->projectName,
                        'pendingTimesheetDates' => $this->pendingTimesheetDates,
                    ]);
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    }
}
