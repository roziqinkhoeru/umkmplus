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
        Schema::create('midtrans_histrories', function (Blueprint $table) {
            $table->id();
            $table->uuid('course_enroll_id');
            $table->foreign('course_enroll_id')->references('id')->on('course_enrolls')->onUpdate('cascade');
            $table->string('transaction_status', 50);
            $table->text('payload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midtrans_histrories');
    }
};
