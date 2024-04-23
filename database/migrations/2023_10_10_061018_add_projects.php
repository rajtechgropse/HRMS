<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('add_projects', function (Blueprint $table) {
            $table->id();
            $table->string('ProjectCompany');
            $table->string('ProjectName');
            $table->decimal('ProjectBudget', 10, 2);
            $table->string('ProjectType');
            $table->string('ProjectManager');
            $table->string('Csm');
            $table->string('Contract');
            $table->string('Tags');
            $table->string('Milestone');
            $table->string('Address');
            $table->string('Comments');
            $table->string('timezone_offset');
            $table->string('cilentname');
            $table->string('cilentemail');
            $table->string('companyname');
            $table->string('cilentphone');
            $table->date('projectstartdate');
            $table->string('status');
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        //
    }
};
