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
        Schema::create('submit_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('usersId');
            $table->string('Bill_Genrate_Date');
            $table->string('DueDate');
            $table->integer('status');
            $table->string('Description');
            $table->string('Quantity');
            $table->string('Price');
            $table->string('Amount');
            $table->string('Total');
            $table->string('Comments');
            $table->string('PaymentOption');       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
