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
        Schema::create('stadiums', function (Blueprint $table) {
            $table->id();
            $table->string('std_name')->nullable()->comment('ชื่อสนาม');
            $table->double('std_price', 7)->nullable()->comment('ราคาสนาม');
            $table->string('std_details')->nullable()->comment('รายละเอียดสนาม');
            $table->string('std_facilities')->nullable()->comment('สิ่งอำนวยสะดวกสนาม');
            $table->text('std_img_path')->nullable()->comment('รูปภาพ');
            $table->string('std_status')->default('1')->comment('สถานะสนาม');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stadiums');
    }
};
