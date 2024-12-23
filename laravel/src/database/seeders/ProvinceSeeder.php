<?php

namespace Database\Seeders;

use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now();
        
        $provinces = [
            [
                "id" => "1",
                "name" => "Thành phố Hà Nội",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "2",
                "name" => "Tỉnh Hà Giang",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "4",
                "name" => "Tỉnh Cao Bằng",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "6",
                "name" => "Tỉnh Bắc Kạn",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "8",
                "name" => "Tỉnh Tuyên Quang",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "10",
                "name" => "Tỉnh Lào Cai",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "11",
                "name" => "Tỉnh Điện Biên",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "12",
                "name" => "Tỉnh Lai Châu",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "14",
                "name" => "Tỉnh Sơn La",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "15",
                "name" => "Tỉnh Yên Bái",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "17",
                "name" => "Tỉnh Hoà Bình",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "19",
                "name" => "Tỉnh Thái Nguyên",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "20",
                "name" => "Tỉnh Lạng Sơn",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "22",
                "name" => "Tỉnh Quảng Ninh",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "24",
                "name" => "Tỉnh Bắc Giang",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "25",
                "name" => "Tỉnh Phú Thọ",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "26",
                "name" => "Tỉnh Vĩnh Phúc",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "27",
                "name" => "Tỉnh Bắc Ninh",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "30",
                "name" => "Tỉnh Hải Dương",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "31",
                "name" => "Thành phố Hải Phòng",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "33",
                "name" => "Tỉnh Hưng Yên",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "34",
                "name" => "Tỉnh Thái Bình",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "35",
                "name" => "Tỉnh Hà Nam",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "36",
                "name" => "Tỉnh Nam Định",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "37",
                "name" => "Tỉnh Ninh Bình",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "38",
                "name" => "Tỉnh Thanh Hóa",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "40",
                "name" => "Tỉnh Nghệ An",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "42",
                "name" => "Tỉnh Hà Tĩnh",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "44",
                "name" => "Tỉnh Quảng Bình",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "45",
                "name" => "Tỉnh Quảng Trị",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "46",
                "name" => "Tỉnh Thừa Thiên Huế",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "48",
                "name" => "Thành phố Đà Nẵng",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "49",
                "name" => "Tỉnh Quảng Nam",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "51",
                "name" => "Tỉnh Quảng Ngãi",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "52",
                "name" => "Tỉnh Bình Định",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "54",
                "name" => "Tỉnh Phú Yên",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "56",
                "name" => "Tỉnh Khánh Hòa",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "58",
                "name" => "Tỉnh Ninh Thuận",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "60",
                "name" => "Tỉnh Bình Thuận",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "62",
                "name" => "Tỉnh Kon Tum",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "64",
                "name" => "Tỉnh Gia Lai",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "66",
                "name" => "Tỉnh Đắk Lắk",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "67",
                "name" => "Tỉnh Đắk Nông",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "68",
                "name" => "Tỉnh Lâm Đồng",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "70",
                "name" => "Tỉnh Bình Phước",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "72",
                "name" => "Tỉnh Tây Ninh",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "74",
                "name" => "Tỉnh Bình Dương",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "75",
                "name" => "Tỉnh Đồng Nai",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "77",
                "name" => "Tỉnh Bà Rịa - Vũng Tàu",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "79",
                "name" => "Thành phố Hồ Chí Minh",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "80",
                "name" => "Tỉnh Long An",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "82",
                "name" => "Tỉnh Tiền Giang",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "83",
                "name" => "Tỉnh Bến Tre",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "84",
                "name" => "Tỉnh Trà Vinh",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "86",
                "name" => "Tỉnh Vĩnh Long",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "87",
                "name" => "Tỉnh Đồng Tháp",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "89",
                "name" => "Tỉnh An Giang",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "91",
                "name" => "Tỉnh Kiên Giang",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "92",
                "name" => "Thành phố Cần Thơ",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "93",
                "name" => "Tỉnh Hậu Giang",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "94",
                "name" => "Tỉnh Sóc Trăng",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "95",
                "name" => "Tỉnh Bạc Liêu",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "96",
                "name" => "Tỉnh Cà Mau",
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ],
        ];

        Province::insert($provinces);
    }
}
