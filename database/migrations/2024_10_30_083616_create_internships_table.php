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
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Corrected 'tittle' to 'title'
            $table->string('location');
            $table->integer('allowance')->default(0); // Consider making allowance nullable if it's optional
            $table->enum('type', ['Full-time', 'Part-time', 'Remote'])->default('Full-time'); // Set a sensible default value
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('internships');
    }
};
