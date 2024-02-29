<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class InitData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('table_quantri')->insert(['ordinal' => '0', 'username' => 'Admin', 'password' => Hash::make('123456'), 'name' => 'Admin', 'permission' => '0', 'status' => '-1']);
        for ($i = 0; $i < 10; $i++) {
            DB::table('table_khachhang')->insert(['ordinal' => $i, 'username' => Str::random(5), 'password' => Hash::make('123456'), 'name' => 'User' . $i, 'status' => '1']);
        }

        DB::table('table_dichvu')->insert(['ordinal' => 1, 'name' => 'Giặt,sấy', 'price' => '200000']);
        DB::table('table_dichvu')->insert(['ordinal' => 2, 'name' => 'Mạng', 'price' => '200000']);
        DB::table('table_dichvu')->insert(['ordinal' => 3, 'name' => 'Vệ sinh', 'price' => '100000']);
        DB::table('table_dichvu')->insert(['ordinal' => 4, 'name' => 'Máy lạnh', 'price' => '200000']);

        DB::table('table_hopdong')->insert(['ordinal' => 1, 'name' => 'Hợp đồng mẫu 1']);
        DB::table('table_hopdong')->insert(['ordinal' => 2, 'name' => 'Hợp đồng mẫu 2']);
        DB::table('table_hopdong')->insert(['ordinal' => 3, 'name' => 'Hợp đồng mẫu 3']);
        DB::table('table_hopdong')->insert(['ordinal' => 4, 'name' => 'Hợp đồng mẫu 4']);

        DB::table('table_phong')->insert(['ordinal' => 1, 'price' => '200000', 'deposittime' => '6', 'electricity_price' => '3500', 'water_price' => '70000', 'area' => '10', 'payday' => '5', 'floor' => '2', 'name' => 'Phòng số 1', 'status' => '1', 'created_at' => Carbon::now()]);
        DB::table('table_phong')->insert(['ordinal' => 2, 'price' => '150000', 'deposittime' => '6', 'electricity_price' => '3500', 'water_price' => '70000', 'area' => '10', 'payday' => '5', 'floor' => '3', 'name' => 'Phòng số 2', 'status' => '1', 'created_at' => Carbon::now()]);
        DB::table('table_phong')->insert(['ordinal' => 3, 'price' => '250000', 'deposittime' => '6', 'electricity_price' => '3500', 'water_price' => '70000', 'area' => '10', 'payday' => '5', 'floor' => '3', 'name' => 'Phòng số 3', 'status' => '1', 'created_at' => Carbon::now()]);
        DB::table('table_phong')->insert(['ordinal' => 4, 'price' => '350000', 'deposittime' => '6', 'electricity_price' => '3500', 'water_price' => '70000', 'area' => '12', 'payday' => '5', 'floor' => '2', 'name' => 'Phòng số 4', 'status' => '1', 'created_at' => Carbon::now()]);
        DB::table('table_phong')->insert(['ordinal' => 5, 'price' => '400000', 'deposittime' => '6', 'electricity_price' => '3500', 'water_price' => '70000', 'area' => '15', 'payday' => '5', 'floor' => '2', 'name' => 'Phòng số 5', 'status' => '0', 'created_at' => Carbon::now()]);
        DB::table('table_phong')->insert(['ordinal' => 6, 'price' => '450000', 'deposittime' => '6', 'electricity_price' => '3500', 'water_price' => '70000', 'area' => '15', 'payday' => '5', 'floor' => '2', 'name' => 'Phòng số 6', 'status' => '0', 'created_at' => Carbon::now()]);
        DB::table('table_phong')->insert(['ordinal' => 7, 'price' => '650000', 'deposittime' => '6', 'electricity_price' => '3500', 'water_price' => '70000', 'area' => '18', 'payday' => '5', 'floor' => '1', 'name' => 'Phòng số 7', 'status' => '0', 'created_at' => Carbon::now()]);
        DB::table('table_phong')->insert(['ordinal' => 8, 'price' => '760000', 'deposittime' => '6', 'electricity_price' => '3500', 'water_price' => '70000', 'area' => '20', 'payday' => '5', 'floor' => '1', 'name' => 'Phòng số 8', 'status' => '0', 'created_at' => Carbon::now()]);

        DB::table('table_dieukhoan')->insert(['ordinal' => 1, 'name' => 'Tự bảo quản đồ cá nhân']);
        DB::table('table_dieukhoan')->insert(['ordinal' => 2, 'name' => 'Không sử dụng, tàn trữ chất kích thích']);
        DB::table('table_dieukhoan')->insert(['ordinal' => 3, 'name' => 'Không ở quá số người đã khai']);
        DB::table('table_dieukhoan')->insert(['ordinal' => 4, 'name' => 'Giữ gìn vệ sinh chung']);

        $stt = 1;
        for ($j = 1; $j <= Carbon::now()->month; $j++) {
            for ($i = 1; $i < rand(2, 5); $i++) {
                DB::table('table_thu')->insert(['ordinal' => $stt, 'name' => 'Phiếu thu ' . $stt, 'content' => 'Nội dung phiếu thu ' . $stt, 'price' => (rand(1, 4) * 100000), 'created_at' => Carbon::create(2023, $j, $i)]);
                DB::table('table_chi')->insert(['ordinal' => $stt, 'name' => 'Phiếu chi ' . $stt, 'content' => 'Nội dung phiếu chi ' . $stt, 'price' => (rand(1, 4) * 10000), 'created_at' => Carbon::create(2023, $j, $i)]);
                $stt++;
            }
        }
    }
}
