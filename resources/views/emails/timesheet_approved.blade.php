<!DOCTYPE html>
<html>
<head>
    <title>Timesheet Approved</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 8px;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .content p {
            line-height: 1.6;
            color: #333333;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #777777;
        }
        .tms {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Timesheet Approved</h1>
        </div>
        <div class="content">
            <p>Hi {{ $user->name }},</p>

            <p>Your timesheet for the week of {{ $weekDates }} has been reviewed and approved.</p>

            <p><strong>Details:</strong></p>
            <ul>
                <li><strong>Week:</strong> {{ $weekDates }}</li>
                <li><strong>Total Hours Submitted:</strong> {{ $totalHours }}</li>
            </ul>

            <p>Thank you for your timely submission and for ensuring that your timesheet was accurate and complete. If you have any questions or require further details, please feel free to reach out.</p>

            <p>Keep up the great work!</p>

            <p>Best regards,<br>
            <span class="tms">TMS</span></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} <span class="tms">TMS</span>. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
