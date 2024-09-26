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
        Schema::create('addworkes_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('userDepartment');
            $table->tinyInteger('status');
<<<<<<< HEAD
=======
            $table->tinyInteger('is_deleted');
            

>>>>>>> 2383766d697e5d985a8032ea182a27c084eead1c
            $table->string('userDesignation');
            $table->integer('userId');
            $table->integer('allocationpercentage');
            $table->tinyInteger('is_deleted');

            $table->date('startdate');
            $table->date('enddate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addworkes_employees');
    }
};
