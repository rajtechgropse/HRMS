@extends('users.header')

@section('title', 'Approval Timesheet')

@section('content')
    <!-- Custom CSS for this page -->
    <style>
        .container {
            margin-top: 30px;
        }
        .description-header {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .description-content {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .description-content p {
            margin: 10px 0;
            font-size: 1rem;
        }
        .description-content strong {
            color: #333;
        }
        .back-button {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="container">
        <div class="description-header">
            <h2>Timesheet Description</h2>
        </div>
        
        <div class="description-content">
            <!-- Display Timesheet Details -->
            <p><strong>Description:</strong> {{ $timeEntry->descriptions }}</p>
        </div>
        
        <!-- Optional: Back to List Button -->
        <a href="{{ route('user.approvalTimesheet') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
@endsection
