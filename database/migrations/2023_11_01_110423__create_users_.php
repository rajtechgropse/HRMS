<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_Id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->tinyInteger('userDepartment')->default(3);
            //  Users: 0=>User, 1=>Admin, 2=>Manager , 3=>Designer, 4=>Developer, 5=>Q/A Engineer  ,6=>Marketing
            // Users: 1=>Delivery , 2=>Marketing , 3=>Admin , 4=>HR , 5=>Business,
            $table->string('userDesignation');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('time_managers_status')->default(0);
            $table->timestamp('last_login_at')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
