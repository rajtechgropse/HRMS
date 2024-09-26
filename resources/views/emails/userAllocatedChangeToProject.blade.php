<!DOCTYPE html>
<html>
<head>
    <title>Project Allocation Update</title>
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
        .team-name {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Project Allocation Update</h1>
        </div>
        <div class="content">
            <p>Hello {{ $employeeName }},</p>

            <p>We wanted to inform you that your allocation to the project "{{ $projectName }}" has been updated.</p>

            <p><strong>Old Allocation:</strong> {{ $oldAllocationPercentage }}%</p>
            <p><strong>New Allocation:</strong> {{ $newAllocationPercentage }}%</p>
            <p><strong>Start Date:</strong> {{ $startdate }}</p>
            <p><strong>End Date:</strong> {{ $enddate }}</p>

            <p>Thank you for your dedication and hard work. We look forward to your contributions to this project.</p>

            <p>Best regards,<br>
            <span class="team-name">TMS Team</span></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} <span class="team-name">TMS</span>. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
