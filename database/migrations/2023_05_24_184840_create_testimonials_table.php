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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->uuid('course_enroll_id');
            $table->foreign('course_enroll_id')->references('id')->on('course_enrolls')->onDelete('cascade')->onUpdate('cascade');
            $table->text('testimonial');
            $table->integer('rating');
            $table->enum('status', ['tampilkan', 'sembunyikan'])->default('sembunyikan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
