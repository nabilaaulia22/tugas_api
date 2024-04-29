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
    Schema::create('down', function (Blueprint $table) {
        $table->id();
        $table->string('ip_address');
        $table->string('unit_name');
        $table->dateTime('down_time');
        $table->dateTime('up_time')->nullable(); // Tambahkan kolom up_time
        $table->integer('duration')->default(0); // Tambahkan kolom duration
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('down');
    }
};
