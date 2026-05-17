<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasteBanksTable extends Migration
{
    public function up()
    {
        Schema::create('waste_banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->text('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('operational_hour')->nullable();
            $table->string('contact_number')->nullable();
            $table->decimal('rating', 3, 1)->default(4.5);
            $table->string('thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->text('accepted_categories')->nullable(); // JSON string
            $table->boolean('is_open')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('waste_banks');
    }
}
