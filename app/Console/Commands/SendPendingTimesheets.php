<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\PendingTimesheetReminder;
<<<<<<< HEAD
use App\Models\addworkesEmployee; // Ensure this is the correct model
use App\Models\TimeEntry; // Ensure this is the correct model
use App\Models\employees; // Ensure this is the correct model
=======
use App\Models\addworkesEmployee; // Adjust the namespace if necessary
use App\Models\TimeEntry; // Adjust the namespace if necessary
use App\Models\employees; // Adjust the namespace if necessary
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
use Carbon\Carbon;

class SendPendingTimesheets extends Command
{
<<<<<<< HEAD
    protected $signature = 'email:send-pending-timesheets';
    protected $description = 'Send reminders for pending timesheets';

=======
    // The name and signature of the console command.
    protected $signature = 'email:send-pending-timesheets';

    // The console command description.
    protected $description = 'Send reminders for pending timesheets';

    // Create a new command instance.
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    public function __construct()
    {
        parent::__construct();
    }

<<<<<<< HEAD
=======
    // Execute the console command.
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
    public function handle()
    {
        Log::info('Starting SendPendingTimesheets command');

        try {
            // Fetch all users' allocation data
            $UsersAllocation = addworkesEmployee::all();
            Log::info('UsersAllocation count:', ['count' => $UsersAllocation->count()]);

<<<<<<< HEAD
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
=======
            // Array to track users who have already been emailed
            $emailedUsers = [];

            foreach ($UsersAllocation as $usersData) {
                $employeeId = $usersData->employee_Id;

                // Skip if this user has already been emailed
                if (in_array($employeeId, $emailedUsers)) {
                    continue;
                }

                Log::info('Processing user data:', ['user_id' => $employeeId]);

                // Get project start date and today's date
                $startDate = Carbon::parse($usersData->startdate);
                $endDate = Carbon::now(); // Today’s date

                // Create an array of all Mondays between startDate and endDate
                $mondaysDates = [];
                $currentDate = $startDate->copy();
                while ($currentDate <= $endDate) {
                    if ($currentDate->dayOfWeek === Carbon::MONDAY) {
                        $mondaysDates[] = $currentDate->toDateString();
                    }
                    $currentDate->addDay();
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                }

                Log::info('Mondays Dates:', ['dates' => $mondaysDates]);

<<<<<<< HEAD
                $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
                    ->where('employee_id', $employeeId)
                    ->where(function ($query) {
                        $query->where('status', 0)
                              ->orWhere('status', '!=', 1);
                    })
=======
                // Fetch submitted timesheets
                $submittedTimesheets = TimeEntry::whereIn('date', $mondaysDates)
                    ->where('employee_id', $employeeId)
                    ->where('status', 1)
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                    ->pluck('date')
                    ->toArray();

                Log::info('Submitted Timesheets:', ['dates' => $submittedTimesheets]);

                $pendingTimesheetDates = array_diff($mondaysDates, $submittedTimesheets);
                Log::info('Pending Timesheet Dates:', ['dates' => $pendingTimesheetDates]);

                if (!empty($pendingTimesheetDates)) {
<<<<<<< HEAD
                    $employee = employees::find($employeeId);
                    if ($employee) {
                        $employeeEmail = $employee->officialemail;
=======
                    $employee = employees::where('id', $employeeId)->first();
                    if ($employee) {
                        // Use actual employee email if available
                        // $employeeEmail = 'rajgupta3xm@gmail.com' ?? 'rajgupta@techgropse.com';
                        $employeeEmail = $employee->officialemail ?? 'default@example.com';

>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                        $employeeName = $employee->name;
                    } else {
                        Log::error('Employee not found:', ['employee_id' => $employeeId]);
                        continue; // Skip to the next user
                    }

                    Log::info('Sending email to:', ['email' => $employeeEmail]);

<<<<<<< HEAD
                    $weekDates = implode(', ', $mondaysDates);
=======
                    $weekDates = implode(', ', $pendingTimesheetDates);
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c

                    Mail::to($employeeEmail)->send(new PendingTimesheetReminder(
                        $employeeName,
                        $employeeEmail,
                        'Project Name', // Adjust if necessary
                        $pendingTimesheetDates
                    ));

                    Log::info('Email sent to:', ['email' => $employeeEmail]);
<<<<<<< HEAD
=======

                    // Mark this user as emailed
                    $emailedUsers[] = $employeeId;
>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
                }
            }

            Log::info('All emails processed successfully!');
        } catch (\Exception $e) {
            Log::error('Error occurred while sending emails:', ['exception' => $e->getMessage()]);
        }
    }
}
