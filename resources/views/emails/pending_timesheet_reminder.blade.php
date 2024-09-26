<!-- resources/views/emails/pending_timesheet_reminder.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pending Timesheets Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .content {
            margin-top: 20px;
        }
        .content p {
            margin: 0;
            padding: 10px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.8em;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Pending Timesheet Reminder</h1>
        </div>
        <div class="content">
            <p>Dear {{ $employeeName }},</p>
            <p>This is a reminder that you have pending timesheets for the following dates:</p>
            <ul>
                @foreach($pendingTimesheetDates as $date)
                    <li>{{ $date }}</li>
                @endforeach
            </ul>
            <p>Please submit your timesheets as soon as possible.</p>
            <p>Thank you!</p>
            <p>Best regards,</p>
            <p>Your Company Name</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
