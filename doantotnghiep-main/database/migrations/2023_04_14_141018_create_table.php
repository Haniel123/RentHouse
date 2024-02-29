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
        Schema::create('table_khachhang', function (Blueprint $table) {
            $table->id();
            $table->longText('ordinal')->nullable();
            $table->string('username');
            $table->longText('password');
            $table->longText('name');
            $table->longText('email')->nullable();
            $table->longText('phone')->nullable();
            $table->longText('birthday')->nullable();
            $table->longText('avatar')->nullable();
            $table->longText('address')->nullable();
            $table->longText('status')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('table_quantri', function (Blueprint $table) {
            $table->id();
            $table->longText('ordinal');
            $table->string('username');
            $table->longText('password');
            $table->longText('name');
            $table->longText('email')->nullable();
            $table->longText('phone')->nullable();
            $table->longText('birthday')->nullable();
            $table->longText('avatar')->nullable();
            $table->longText('permission');
            $table->longText('address')->nullable();
            $table->longText('status')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('table_phong', function (Blueprint $table) {
            $table->id();
            $table->longText('ordinal');
            $table->longText('name');
            $table->longText('desc')->nullable();
            $table->longText('content')->nullable();
            $table->double('price')->nullable();
            $table->longText('deposittime')->nullable();
            $table->double('electricity_price')->nullable();
            $table->double('water_price')->nullable();
            $table->longText('area')->nullable();
            $table->longText('payday')->nullable();
            $table->longText('floor')->nullable();
            $table->longText('status')->nullable();
            $table->longText('picture')->nullable();
            $table->longText('options')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('table_hopdong', function (Blueprint $table) {
            $table->id();
            $table->longText('ordinal');
            $table->longText('name');
            $table->longText('content')->nullable();
            $table->longText('deposit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('table_phong_hopdong', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_hopdong')->nullable()->constrained('table_hopdong');
            $table->foreignId('id_khachhang')->nullable()->constrained('table_khachhang');
            $table->foreignId('id_quantri')->nullable()->constrained('table_quantri');
            $table->foreignId('id_phong')->nullable()->constrained('table_phong');
            $table->longText('rental_start_date')->nullable();
            $table->longText('amount')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('table_phong_thue', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_khachhang')->nullable()->constrained('table_khachhang');
            $table->foreignId('id_phong')->nullable()->constrained('table_phong');
            $table->longText('rental_start_date')->nullable();
            $table->longText('rental_end_date')->nullable();
            $table->longText('amount')->nullable();
            $table->foreignId('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('table_dieukhoan', function (Blueprint $table) {
            $table->id();
            $table->longText('ordinal');
            $table->longText('name');
            $table->longText('content')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('table_hopdong_dieukhoan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_hopdong')->nullable()->constrained('table_hopdong');
            $table->foreignId('id_dieukhoan')->nullable()->constrained('table_dieukhoan');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('table_dichvu', function (Blueprint $table) {
            $table->id();
            $table->longText('ordinal');
            $table->longText('name');
            $table->double('price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('table_phong_dichvu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_phong')->nullable()->constrained('table_phong');
            $table->foreignId('id_dichvu')->nullable()->constrained('table_dichvu');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('table_baiviet', function (Blueprint $table) {
            $table->id();
            $table->longText('ordinal');
            $table->longText('name');
            $table->longText('photo')->nullable();
            $table->longText('desc')->nullable();
            $table->longText('content')->nullable();
            $table->longText('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('table_thongtin', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->longText('hotline')->nullable();
            $table->longText('fanpage')->nullable();
            $table->longText('facebook')->nullable();
            $table->longText('video')->nullable();
            $table->longText('address')->nullable();
            $table->longText('map')->nullable();
            $table->longText('content')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('table_thu', function (Blueprint $table) {
            $table->id();
            $table->longText('ordinal');
            $table->foreignId('id_phong')->nullable();
            $table->foreignId('id_khachhang')->nullable();
            $table->foreignId('id_quantri')->nullable();
            $table->longText('name')->nullable();
            $table->longText('namebook')->nullable();
            $table->longText('content')->nullable();
            $table->double('price')->nullable();
            $table->longText('phone')->nullable();
            $table->longText('email')->nullable();
            $table->longText('code')->nullable();
            $table->longText('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('table_phanhoi', function (Blueprint $table) {
            $table->id();
            $table->longText('ordinal');
            $table->foreignId('id_phong')->nullable();
            $table->foreignId('id_khachhang')->nullable();
            $table->longText('content')->nullable();
            $table->longText('status')->nullable();
            $table->longText('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('table_chi', function (Blueprint $table) {
            $table->id();
            $table->longText('ordinal');
            $table->foreignId('id_admin')->nullable()->constrained('table_quantri');
            $table->longText('name')->nullable();
            $table->longText('content')->nullable();
            $table->double('price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_chi');
        Schema::dropIfExists('table_phanhoi');
        Schema::dropIfExists('table_thu');
        Schema::dropIfExists('table_phong_hopdong');
        Schema::dropIfExists('table_hopdong_dieukhoan');
        Schema::dropIfExists('table_dieukhoan');
        Schema::dropIfExists('table_hopdong');
        Schema::dropIfExists('table_noithat');
        Schema::dropIfExists('table_phong_dichvu');
        Schema::dropIfExists('table_dichvu');
        Schema::dropIfExists('table_thongtin');
        Schema::dropIfExists('table_baiviet');
        Schema::dropIfExists('table_quantri');
        Schema::dropIfExists('table_phong_thue');
        Schema::dropIfExists('table_phong');
        Schema::dropIfExists('table_khachhang');
    }
};
