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
        Schema::create('course_enrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('customers')->onUpdate('cascade');
            $table->foreignId('course_id')->constrained('courses')->onUpdate('cascade')->onDelete('restrict');
            $table->enum('status', ['menunggu pembayaran', 'proses', 'aktif', 'selesai']);
            $table->string('payment_proof', 255);
            $table->integer('upto_no_module')->default(0);
            $table->integer('upto_no_media')->default(0);
            $table->date('started_at');
            $table->date('finished_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_enrolls');
    }
};
