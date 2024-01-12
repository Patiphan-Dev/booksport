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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('bk_std_id',2)->nullable()->comment('รหัสสนาม');
            $table->string('bk_username')->nullable()->comment('ชื่อผู้จอง');
            $table->date('bk_date')->nullable()->comment('วันที่จอง');
            $table->time('bk_str_time')->nullable()->comment('เวลาจอง');
            $table->time('bk_end_time')->nullable()->comment('เวลาออก');
            $table->string('bk_slip')->nullable()->comment('สลิป');
            $table->string('bk_status')->default('1')->comment('สถานะการชำระเงิน');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
