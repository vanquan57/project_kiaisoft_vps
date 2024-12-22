<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [

            [
                'id' => 1,
                'name' => 'Thành phố Hà Nội',
            ],

            [
                'id' => 2,
                'name' => 'Tỉnh Hà Giang',
            ],

            [
                'id' => 4,
                'name' => 'Tỉnh Cao Bằng',
            ],

            [
                'id' => 6,
                'name' => 'Tỉnh Bắc Kạn',
            ],

            [
                'id' => 8,
                'name' => 'Tỉnh Tuyên Quang',
            ],

            [
                'id' => 10,
                'name' => 'Tỉnh Lào Cai',
            ],

            [
                'id' => 11,
                'name' => 'Tỉnh Điện Biên',
            ],

            [
                'id' => 12,
                'name' => 'Tỉnh Lai Châu',
            ],

            [
                'id' => 14,
                'name' => 'Tỉnh Sơn La',
            ],

            [
                'id' => 15,
                'name' => 'Tỉnh Yên Bái',
            ],

            [
                'id' => 17,
                'name' => 'Tỉnh Hoà Bình',
            ],

            [
                'id' => 19,
                'name' => 'Tỉnh Thái Nguyên',
            ],

            [
                'id' => 20,
                'name' => 'Tỉnh Lạng Sơn',
            ],

            [
                'id' => 22,
                'name' => 'Tỉnh Quảng Ninh',
            ],

            [
                'id' => 24,
                'name' => 'Tỉnh Bắc Giang',
            ],

            [
                'id' => 25,
                'name' => 'Tỉnh Phú Thọ',
            ],

            [
                'id' => 26,
                'name' => 'Tỉnh Vĩnh Phúc',
            ],

            [
                'id' => 27,
                'name' => 'Tỉnh Bắc Ninh',
            ],

            [
                'id' => 30,
                'name' => 'Tỉnh Hải Dương',
            ],

            [
                'id' => 31,
                'name' => 'Thành phố Hải Phòng',
            ],

            [
                'id' => 33,
                'name' => 'Tỉnh Hưng Yên',
            ],

            [
                'id' => 34,
                'name' => 'Tỉnh Thái Bình',
            ],

            [
                'id' => 35,
                'name' => 'Tỉnh Hà Nam',
            ],

            [
                'id' => 36,
                'name' => 'Tỉnh Nam Định',
            ],

            [
                'id' => 37,
                'name' => 'Tỉnh Ninh Bình',
            ],

            [
                'id' => 38,
                'name' => 'Tỉnh Thanh Hóa',
            ],

            [
                'id' => 40,
                'name' => 'Tỉnh Nghệ An',
            ],

            [
                'id' => 42,
                'name' => 'Tỉnh Hà Tĩnh',
            ],

            [
                'id' => 44,
                'name' => 'Tỉnh Quảng Bình',
            ],

            [
                'id' => 45,
                'name' => 'Tỉnh Quảng Trị',
            ],

            [
                'id' => 46,
                'name' => 'Tỉnh Thừa Thiên Huế',
            ],

            [
                'id' => 48,
                'name' => 'Thành phố Đà Nẵng',
            ],

            [
                'id' => 49,
                'name' => 'Tỉnh Quảng Nam',
            ],

            [
                'id' => 51,
                'name' => 'Tỉnh Quảng Ngãi',
            ],

            [
                'id' => 52,
                'name' => 'Tỉnh Bình Định',
            ],

            [
                'id' => 54,
                'name' => 'Tỉnh Phú Yên',
            ],

            [
                'id' => 56,
                'name' => 'Tỉnh Khánh Hòa',
            ],

            [
                'id' => 58,
                'name' => 'Tỉnh Ninh Thuận',
            ],

            [
                'id' => 60,
                'name' => 'Tỉnh Bình Thuận',
            ],

            [
                'id' => 62,
                'name' => 'Tỉnh Kon Tum',
            ],

            [
                'id' => 64,
                'name' => 'Tỉnh Gia Lai',
            ],

            [
                'id' => 66,
                'name' => 'Tỉnh Đắk Lắk',
            ],

            [
                'id' => 67,
                'name' => 'Tỉnh Đắk Nông',
            ],

            [
                'id' => 68,
                'name' => 'Tỉnh Lâm Đồng',
            ],

            [
                'id' => 70,
                'name' => 'Tỉnh Bình Phước',
            ],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}
