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
            $table->string('Projectcompany');
            $table->string('Companyname');
            $table->string('Cilentname');
            $table->string('Cilentemail');
            $table->string('Cilentphone');
            $table->string('Address');
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
