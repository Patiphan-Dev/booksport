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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable()->comment('ชื่อผู้ใช้งาน');
            $table->string('email')->unique()->comment('อีเมล');
            $table->string('password')->nullable()->comment('รหัสผ่าน');
            $table->string('qrcode')->nullable()->comment('qrcode ชำระเงิน');
            $table->string('status')->default('1')->comment('สถานะ');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
