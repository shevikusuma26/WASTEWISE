<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWasteScansTable extends Migration
{
    public function up()
    {
        Schema::create('waste_scans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('waste_categories')->onDelete('set null');
            $table->string('image');
            $table->decimal('confidence_score', 5, 2)->nullable();
            $table->string('scan_result');
            $table->text('recommendation')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('waste_scans');
    }
}
