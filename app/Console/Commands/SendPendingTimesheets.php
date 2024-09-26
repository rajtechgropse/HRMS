<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendingTimesheetReminder;
use App\Models\addworkesEmployee; // Ensure this is the correct model
use App\Models\TimeEntry; // Ensure this is the correct model
use App\Models\employees; // Ensure this is the correct model
use Carbon\Carbon;

class SendPendingTimesheets extends Command
{
    protected $signature = 'email:send-pending-timesheets';
    protected $description = 'Send reminders for pending timesheets';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Log::info('Starting SendPendingTimesheets command');

        try {
            // Fetch all users' allocation data
            $UsersAllocation = addworkesEmployee::all();
            Log::info('UsersAllocation count:', ['count' => $UsersAllocation->count()]);

            foreach ($UsersAllocation as $usersData) {
                Log::info('Processing user data:', ['user_id' => $usersData->employee_Id]);

                $employeeId = $usersData->employee_Id;
                $startDate = $usersData->startdate;
                $endDate = $usersData->enddate;

                $carbonStartDate = Carbon::parse($startDate);
                $carbonEndDate = Carbon::parse($endDate);

                $mondaysDates = [];
                while ($carbonStartDate <= $carbonEndDate) {
                    if ($carbonStartDate->dayOfWeek === Carbon::MONDAY) {
                        $mondaysDates[] = $carbonStartDate->toDateString();
                    }
                    $carbonStartDate->addDay();
                }

                Log::info('Mondays Dates:', ['dates' => $mondaysDates]);

                $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
                    ->where('employee_id', $employeeId)
                    ->where(function ($query) {
                        $query->where('status', 0)
                              ->orWhere('status', '!=', 1);
                    })
                    ->pluck('date')
                    ->toArray();

                Log::info('Submitted Timesheets:', ['dates' => $submittedTimesheets]);

                $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheets);
                Log::info('Pending Timesheet Dates:', ['dates' => $pendingTimesheetDates]);

                if (!empty($pendingTimesheetDates)) {
                    $employee = employees::find($employeeId);
                    if ($employee) {
                        $employeeEmail = $employee->officialemail;
                        $employeeName = $employee->name;
                    } else {
                        Log::error('Employee not found:', ['employee_id' => $employeeId]);
                        continue; // Skip to the next user
                    }

                    Log::info('Sending email to:', ['email' => $employeeEmail]);

                    $weekDates = implode(', ', $mondaysDates);

                    Mail::to($employeeEmail)->send(new PendingTimesheetReminder(
                        $employeeName,
                        $employeeEmail,
                        'Project Name', // Adjust if necessary
                        $pendingTimesheetDates
                    ));

                    Log::info('Email sent to:', ['email' => $employeeEmail]);
                }
            }

            Log::info('All emails processed successfully!');
        } catch (\Exception $e) {
            Log::error('Error occurred while sending emails:', ['exception' => $e->getMessage()]);
        }
    }
}
