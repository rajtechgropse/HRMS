<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reopen_timesheets', function (Blueprint $table) {
            $table->id();
            $table->integer('timesheet_id')->unsigned(); // Reference to the original timesheet ID
            $table->integer('project_id')->unsigned();    // Reference to the project
            $table->integer('employee_id')->unsigned();   // Reference to the employee
            $table->date('date');
            $table->string('day');
            $table->integer('status'); // E.g., 0 for pending, 1 for approved
            $table->text('reopen_reason_user');
            // $table->tinyInteger('is_ProjectManagers'); // 1 approved ,2 :rejected 3 :pending
            $table->integer('approved_by_employee_id')->nullable(); // Employee who approved
            $table->text('rejection_reason')->nullable();
            $table->decimal('monday_hours', 5, 2);
            $table->decimal('tuesday_hours', 5, 2);
            $table->decimal('wednesday_hours', 5, 2);
            $table->decimal('thursday_hours', 5, 2);
            $table->decimal('friday_hours', 5, 2);
            $table->decimal('saturday_hours', 5, 2);
            $table->decimal('sunday_hours', 5, 2);
            $table->decimal('total_hours', 5, 2);
            $table->text('descriptions');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reopen_timesheets');
    }
};
