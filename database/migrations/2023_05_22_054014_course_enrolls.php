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
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('customers')->onUpdate('cascade');
            $table->foreignId('course_id')->constrained('courses')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('discount_id')->nullable()->constrained('discounts')->onUpdate('restrict')->onDelete('restrict');
            $table->enum('status', ['menunggu pembayaran', 'proses', 'aktif', 'selesai'])->default('menunggu pembayaran');
            $table->integer('upto_no_module')->default(0);
            $table->integer('upto_no_media')->default(0);
            $table->date('started_at')->nullable();
            $table->date('finished_at')->nullable();
            $table->bigInteger('total_price');
            $table->string('snap_token', 255)->nullable();
            $table->string('snap_url', 255)->nullable();
            $table->integer('score')->nullable();
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
