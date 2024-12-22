<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            [
                'id' => '461',
                'name' => 'Thành phố Đông Hà',
                'province_id' => '45',
            ],
            [
                'id' => '462',
                'name' => 'Thị xã Quảng Trị',
                'province_id' => '45',
            ],
            [
                'id' => '464',
                'name' => 'Huyện Vĩnh Linh',
                'province_id' => '45',
            ],
            [
                'id' => '465',
                'name' => 'Huyện Hướng Hóa',
                'province_id' => '45',
            ],
            [
                'id' => '466',
                'name' => 'Huyện Gio Linh',
                'province_id' => '45',
            ],
            [
                'id' => '467',
                'name' => 'Huyện Đa Krông',
                'province_id' => '45',
            ],
            [
                'id' => '468',
                'name' => 'Huyện Cam Lộ',
                'province_id' => '45',
            ],
            [
                'id' => '469',
                'name' => 'Huyện Triệu Phong',
                'province_id' => '45',
            ],
            [
                'id' => '470',
                'name' => 'Huyện Hải Lăng',
                'province_id' => '45',
            ],
            [
                'id' => '490',
                'name' => 'Quận Liên Chiểu',
                'province_id' => '48',
            ],
            [
                'id' => '491',
                'name' => 'Quận Thanh Khê',
                'province_id' => '48',
            ],
            [
                'id' => '492',
                'name' => 'Quận Hải Châu',
                'province_id' => '48',
            ],
            [
                'id' => '493',
                'name' => 'Quận Sơn Trà',
                'province_id' => '48',
            ],
            [
                'id' => '494',
                'name' => 'Quận Ngũ Hành Sơn',
                'province_id' => '48',
            ],
            [
                'id' => '495',
                'name' => 'Quận Cẩm Lệ',
                'province_id' => '48',
            ],
            [
                'id' => '497',
                'name' => 'Huyện Hòa Vang',
                'province_id' => '48',
            ],
            [
                'id' => '498',
                'name' => 'Huyện Hoàng Sa',
                'province_id' => '48',
            ],
        ];

        foreach ($districts as $district) {
            District::create($district);
        }
    }
}
