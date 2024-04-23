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
        Schema::create('mileStone', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->string('name');
            $table->time('hours');
            $table->date('StartDate');

            $table->string('targetComplectionDate');
            $table->string('description');
            $table->timestamps('');
           
        });
    }
  
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mileStone');
    }
};