<?php

namespace Database\Seeders;

use App\Models\District;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now();

        $districts = [
            [
                "id" => "1",
                "name" => "Quận Ba Đình",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "2",
                "name" => "Quận Hoàn Kiếm",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "3",
                "name" => "Quận Tây Hồ",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "4",
                "name" => "Quận Long Biên",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "5",
                "name" => "Quận Cầu Giấy",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "6",
                "name" => "Quận Đống Đa",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "7",
                "name" => "Quận Hai Bà Trưng",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "8",
                "name" => "Quận Hoàng Mai",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "9",
                "name" => "Quận Thanh Xuân",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "16",
                "name" => "Huyện Sóc Sơn",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "17",
                "name" => "Huyện Đông Anh",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "18",
                "name" => "Huyện Gia Lâm",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "19",
                "name" => "Quận Nam Từ Liêm",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "20",
                "name" => "Huyện Thanh Trì",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "21",
                "name" => "Quận Bắc Từ Liêm",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "250",
                "name" => "Huyện Mê Linh",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "268",
                "name" => "Quận Hà Đông",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "269",
                "name" => "Thị xã Sơn Tây",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "271",
                "name" => "Huyện Ba Vì",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "272",
                "name" => "Huyện Phúc Thọ",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "273",
                "name" => "Huyện Đan Phượng",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "274",
                "name" => "Huyện Hoài Đức",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "275",
                "name" => "Huyện Quốc Oai",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "276",
                "name" => "Huyện Thạch Thất",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "277",
                "name" => "Huyện Chương Mỹ",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "278",
                "name" => "Huyện Thanh Oai",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "279",
                "name" => "Huyện Thường Tín",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "280",
                "name" => "Huyện Phú Xuyên",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "281",
                "name" => "Huyện Ứng Hòa",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "282",
                "name" => "Huyện Mỹ Đức",
                "province_id" => "1",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "24",
                "name" => "Thành phố Hà Giang",
                "province_id" => "2",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "26",
                "name" => "Huyện Đồng Văn",
                "province_id" => "2",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "27",
                "name" => "Huyện Mèo Vạc",
                "province_id" => "2",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "28",
                "name" => "Huyện Yên Minh",
                "province_id" => "2",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "29",
                "name" => "Huyện Quản Bạ",
                "province_id" => "2",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "30",
                "name" => "Huyện Vị Xuyên",
                "province_id" => "2",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "31",
                "name" => "Huyện Bắc Mê",
                "province_id" => "2",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "32",
                "name" => "Huyện Hoàng Su Phì",
                "province_id" => "2",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "33",
                "name" => "Huyện Xín Mần",
                "province_id" => "2",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "34",
                "name" => "Huyện Bắc Quang",
                "province_id" => "2",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "35",
                "name" => "Huyện Quang Bình",
                "province_id" => "2",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "40",
                "name" => "Thành phố Cao Bằng",
                "province_id" => "4",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "42",
                "name" => "Huyện Bảo Lâm",
                "province_id" => "4",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "43",
                "name" => "Huyện Bảo Lạc",
                "province_id" => "4",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "45",
                "name" => "Huyện Hà Quảng",
                "province_id" => "4",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "47",
                "name" => "Huyện Trùng Khánh",
                "province_id" => "4",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "48",
                "name" => "Huyện Hạ Lang",
                "province_id" => "4",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "49",
                "name" => "Huyện Quảng Hòa",
                "province_id" => "4",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "51",
                "name" => "Huyện Hoà An",
                "province_id" => "4",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "52",
                "name" => "Huyện Nguyên Bình",
                "province_id" => "4",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "53",
                "name" => "Huyện Thạch An",
                "province_id" => "4",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "58",
                "name" => "Thành Phố Bắc Kạn",
                "province_id" => "6",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "60",
                "name" => "Huyện Pác Nặm",
                "province_id" => "6",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "61",
                "name" => "Huyện Ba Bể",
                "province_id" => "6",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "62",
                "name" => "Huyện Ngân Sơn",
                "province_id" => "6",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "63",
                "name" => "Huyện Bạch Thông",
                "province_id" => "6",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "64",
                "name" => "Huyện Chợ Đồn",
                "province_id" => "6",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "65",
                "name" => "Huyện Chợ Mới",
                "province_id" => "6",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "66",
                "name" => "Huyện Na Rì",
                "province_id" => "6",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "70",
                "name" => "Thành phố Tuyên Quang",
                "province_id" => "8",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "71",
                "name" => "Huyện Lâm Bình",
                "province_id" => "8",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "72",
                "name" => "Huyện Na Hang",
                "province_id" => "8",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "73",
                "name" => "Huyện Chiêm Hóa",
                "province_id" => "8",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "74",
                "name" => "Huyện Hàm Yên",
                "province_id" => "8",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "75",
                "name" => "Huyện Yên Sơn",
                "province_id" => "8",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "76",
                "name" => "Huyện Sơn Dương",
                "province_id" => "8",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "80",
                "name" => "Thành phố Lào Cai",
                "province_id" => "10",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "82",
                "name" => "Huyện Bát Xát",
                "province_id" => "10",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "83",
                "name" => "Huyện Mường Khương",
                "province_id" => "10",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "84",
                "name" => "Huyện Si Ma Cai",
                "province_id" => "10",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "85",
                "name" => "Huyện Bắc Hà",
                "province_id" => "10",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "86",
                "name" => "Huyện Bảo Thắng",
                "province_id" => "10",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "87",
                "name" => "Huyện Bảo Yên",
                "province_id" => "10",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "88",
                "name" => "Thị xã Sa Pa",
                "province_id" => "10",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "89",
                "name" => "Huyện Văn Bàn",
                "province_id" => "10",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "94",
                "name" => "Thành phố Điện Biên Phủ",
                "province_id" => "11",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "95",
                "name" => "Thị xã Mường Lay",
                "province_id" => "11",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "96",
                "name" => "Huyện Mường Nhé",
                "province_id" => "11",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "97",
                "name" => "Huyện Mường Chà",
                "province_id" => "11",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "98",
                "name" => "Huyện Tủa Chùa",
                "province_id" => "11",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "99",
                "name" => "Huyện Tuần Giáo",
                "province_id" => "11",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "100",
                "name" => "Huyện Điện Biên",
                "province_id" => "11",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "101",
                "name" => "Huyện Điện Biên Đông",
                "province_id" => "11",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "102",
                "name" => "Huyện Mường Ảng",
                "province_id" => "11",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "103",
                "name" => "Huyện Nậm Pồ",
                "province_id" => "11",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "105",
                "name" => "Thành phố Lai Châu",
                "province_id" => "12",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "106",
                "name" => "Huyện Tam Đường",
                "province_id" => "12",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "107",
                "name" => "Huyện Mường Tè",
                "province_id" => "12",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "108",
                "name" => "Huyện Sìn Hồ",
                "province_id" => "12",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "109",
                "name" => "Huyện Phong Thổ",
                "province_id" => "12",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "110",
                "name" => "Huyện Than Uyên",
                "province_id" => "12",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "111",
                "name" => "Huyện Tân Uyên",
                "province_id" => "12",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "112",
                "name" => "Huyện Nậm Nhùn",
                "province_id" => "12",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "116",
                "name" => "Thành phố Sơn La",
                "province_id" => "14",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "118",
                "name" => "Huyện Quỳnh Nhai",
                "province_id" => "14",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "119",
                "name" => "Huyện Thuận Châu",
                "province_id" => "14",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "120",
                "name" => "Huyện Mường La",
                "province_id" => "14",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "121",
                "name" => "Huyện Bắc Yên",
                "province_id" => "14",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "122",
                "name" => "Huyện Phù Yên",
                "province_id" => "14",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "123",
                "name" => "Huyện Mộc Châu",
                "province_id" => "14",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "124",
                "name" => "Huyện Yên Châu",
                "province_id" => "14",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "125",
                "name" => "Huyện Mai Sơn",
                "province_id" => "14",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "126",
                "name" => "Huyện Sông Mã",
                "province_id" => "14",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "127",
                "name" => "Huyện Sốp Cộp",
                "province_id" => "14",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "128",
                "name" => "Huyện Vân Hồ",
                "province_id" => "14",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "132",
                "name" => "Thành phố Yên Bái",
                "province_id" => "15",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "133",
                "name" => "Thị xã Nghĩa Lộ",
                "province_id" => "15",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "135",
                "name" => "Huyện Lục Yên",
                "province_id" => "15",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "136",
                "name" => "Huyện Văn Yên",
                "province_id" => "15",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "137",
                "name" => "Huyện Mù Căng Chải",
                "province_id" => "15",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "138",
                "name" => "Huyện Trấn Yên",
                "province_id" => "15",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "139",
                "name" => "Huyện Trạm Tấu",
                "province_id" => "15",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "140",
                "name" => "Huyện Văn Chấn",
                "province_id" => "15",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "141",
                "name" => "Huyện Yên Bình",
                "province_id" => "15",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "148",
                "name" => "Thành phố Hòa Bình",
                "province_id" => "17",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "150",
                "name" => "Huyện Đà Bắc",
                "province_id" => "17",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "152",
                "name" => "Huyện Lương Sơn",
                "province_id" => "17",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "153",
                "name" => "Huyện Kim Bôi",
                "province_id" => "17",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "154",
                "name" => "Huyện Cao Phong",
                "province_id" => "17",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "155",
                "name" => "Huyện Tân Lạc",
                "province_id" => "17",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "156",
                "name" => "Huyện Mai Châu",
                "province_id" => "17",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "157",
                "name" => "Huyện Lạc Sơn",
                "province_id" => "17",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "158",
                "name" => "Huyện Yên Thủy",
                "province_id" => "17",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "159",
                "name" => "Huyện Lạc Thủy",
                "province_id" => "17",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "164",
                "name" => "Thành phố Thái Nguyên",
                "province_id" => "19",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "165",
                "name" => "Thành phố Sông Công",
                "province_id" => "19",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "167",
                "name" => "Huyện Định Hóa",
                "province_id" => "19",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "168",
                "name" => "Huyện Phú Lương",
                "province_id" => "19",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "169",
                "name" => "Huyện Đồng Hỷ",
                "province_id" => "19",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "170",
                "name" => "Huyện Võ Nhai",
                "province_id" => "19",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "171",
                "name" => "Huyện Đại Từ",
                "province_id" => "19",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "172",
                "name" => "Thành phố Phổ Yên",
                "province_id" => "19",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "173",
                "name" => "Huyện Phú Bình",
                "province_id" => "19",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "178",
                "name" => "Thành phố Lạng Sơn",
                "province_id" => "20",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "180",
                "name" => "Huyện Tràng Định",
                "province_id" => "20",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "181",
                "name" => "Huyện Bình Gia",
                "province_id" => "20",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "182",
                "name" => "Huyện Văn Lãng",
                "province_id" => "20",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "183",
                "name" => "Huyện Cao Lộc",
                "province_id" => "20",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "184",
                "name" => "Huyện Văn Quan",
                "province_id" => "20",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "185",
                "name" => "Huyện Bắc Sơn",
                "province_id" => "20",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "186",
                "name" => "Huyện Hữu Lũng",
                "province_id" => "20",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "187",
                "name" => "Huyện Chi Lăng",
                "province_id" => "20",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "188",
                "name" => "Huyện Lộc Bình",
                "province_id" => "20",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "189",
                "name" => "Huyện Đình Lập",
                "province_id" => "20",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "193",
                "name" => "Thành phố Hạ Long",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "194",
                "name" => "Thành phố Móng Cái",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "195",
                "name" => "Thành phố Cẩm Phả",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "196",
                "name" => "Thành phố Uông Bí",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "198",
                "name" => "Huyện Bình Liêu",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "199",
                "name" => "Huyện Tiên Yên",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "200",
                "name" => "Huyện Đầm Hà",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "201",
                "name" => "Huyện Hải Hà",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "202",
                "name" => "Huyện Ba Chẽ",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "203",
                "name" => "Huyện Vân Đồn",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "205",
                "name" => "Thị xã Đông Triều",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "206",
                "name" => "Thị xã Quảng Yên",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "207",
                "name" => "Huyện Cô Tô",
                "province_id" => "22",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "213",
                "name" => "Thành phố Bắc Giang",
                "province_id" => "24",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "215",
                "name" => "Huyện Yên Thế",
                "province_id" => "24",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "216",
                "name" => "Huyện Tân Yên",
                "province_id" => "24",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "217",
                "name" => "Huyện Lạng Giang",
                "province_id" => "24",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "218",
                "name" => "Huyện Lục Nam",
                "province_id" => "24",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "219",
                "name" => "Huyện Lục Ngạn",
                "province_id" => "24",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "220",
                "name" => "Huyện Sơn Động",
                "province_id" => "24",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "221",
                "name" => "Huyện Yên Dũng",
                "province_id" => "24",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "222",
                "name" => "Huyện Việt Yên",
                "province_id" => "24",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "223",
                "name" => "Huyện Hiệp Hòa",
                "province_id" => "24",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "227",
                "name" => "Thành phố Việt Trì",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "228",
                "name" => "Thị xã Phú Thọ",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "230",
                "name" => "Huyện Đoan Hùng",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "231",
                "name" => "Huyện Hạ Hoà",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "232",
                "name" => "Huyện Thanh Ba",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "233",
                "name" => "Huyện Phù Ninh",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "234",
                "name" => "Huyện Yên Lập",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "235",
                "name" => "Huyện Cẩm Khê",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "236",
                "name" => "Huyện Tam Nông",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "237",
                "name" => "Huyện Lâm Thao",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "238",
                "name" => "Huyện Thanh Sơn",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "239",
                "name" => "Huyện Thanh Thuỷ",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "240",
                "name" => "Huyện Tân Sơn",
                "province_id" => "25",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "243",
                "name" => "Thành phố Vĩnh Yên",
                "province_id" => "26",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "244",
                "name" => "Thành phố Phúc Yên",
                "province_id" => "26",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "246",
                "name" => "Huyện Lập Thạch",
                "province_id" => "26",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "247",
                "name" => "Huyện Tam Dương",
                "province_id" => "26",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "248",
                "name" => "Huyện Tam Đảo",
                "province_id" => "26",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "249",
                "name" => "Huyện Bình Xuyên",
                "province_id" => "26",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "251",
                "name" => "Huyện Yên Lạc",
                "province_id" => "26",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "252",
                "name" => "Huyện Vĩnh Tường",
                "province_id" => "26",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "253",
                "name" => "Huyện Sông Lô",
                "province_id" => "26",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "256",
                "name" => "Thành phố Bắc Ninh",
                "province_id" => "27",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "258",
                "name" => "Huyện Yên Phong",
                "province_id" => "27",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "259",
                "name" => "Thị xã Quế Võ",
                "province_id" => "27",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "260",
                "name" => "Huyện Tiên Du",
                "province_id" => "27",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "261",
                "name" => "Thành phố Từ Sơn",
                "province_id" => "27",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "262",
                "name" => "Thị xã Thuận Thành",
                "province_id" => "27",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "263",
                "name" => "Huyện Gia Bình",
                "province_id" => "27",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "264",
                "name" => "Huyện Lương Tài",
                "province_id" => "27",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "288",
                "name" => "Thành phố Hải Dương",
                "province_id" => "30",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "290",
                "name" => "Thành phố Chí Linh",
                "province_id" => "30",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "291",
                "name" => "Huyện Nam Sách",
                "province_id" => "30",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "292",
                "name" => "Thị xã Kinh Môn",
                "province_id" => "30",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "293",
                "name" => "Huyện Kim Thành",
                "province_id" => "30",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "294",
                "name" => "Huyện Thanh Hà",
                "province_id" => "30",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "295",
                "name" => "Huyện Cẩm Giàng",
                "province_id" => "30",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "296",
                "name" => "Huyện Bình Giang",
                "province_id" => "30",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "297",
                "name" => "Huyện Gia Lộc",
                "province_id" => "30",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "298",
                "name" => "Huyện Tứ Kỳ",
                "province_id" => "30",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "299",
                "name" => "Huyện Ninh Giang",
                "province_id" => "30",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "300",
                "name" => "Huyện Thanh Miện",
                "province_id" => "30",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "303",
                "name" => "Quận Hồng Bàng",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "304",
                "name" => "Quận Ngô Quyền",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "305",
                "name" => "Quận Lê Chân",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "306",
                "name" => "Quận Hải An",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "307",
                "name" => "Quận Kiến An",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "308",
                "name" => "Quận Đồ Sơn",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "309",
                "name" => "Quận Dương Kinh",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "311",
                "name" => "Huyện Thuỷ Nguyên",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "312",
                "name" => "Huyện An Dương",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "313",
                "name" => "Huyện An Lão",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "314",
                "name" => "Huyện Kiến Thuỵ",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "315",
                "name" => "Huyện Tiên Lãng",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "316",
                "name" => "Huyện Vĩnh Bảo",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "317",
                "name" => "Huyện Cát Hải",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "318",
                "name" => "Huyện Bạch Long Vĩ",
                "province_id" => "31",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "323",
                "name" => "Thành phố Hưng Yên",
                "province_id" => "33",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "325",
                "name" => "Huyện Văn Lâm",
                "province_id" => "33",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "326",
                "name" => "Huyện Văn Giang",
                "province_id" => "33",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "327",
                "name" => "Huyện Yên Mỹ",
                "province_id" => "33",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "328",
                "name" => "Thị xã Mỹ Hào",
                "province_id" => "33",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "329",
                "name" => "Huyện Ân Thi",
                "province_id" => "33",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "330",
                "name" => "Huyện Khoái Châu",
                "province_id" => "33",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "331",
                "name" => "Huyện Kim Động",
                "province_id" => "33",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "332",
                "name" => "Huyện Tiên Lữ",
                "province_id" => "33",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "333",
                "name" => "Huyện Phù Cừ",
                "province_id" => "33",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "336",
                "name" => "Thành phố Thái Bình",
                "province_id" => "34",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "338",
                "name" => "Huyện Quỳnh Phụ",
                "province_id" => "34",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "339",
                "name" => "Huyện Hưng Hà",
                "province_id" => "34",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "340",
                "name" => "Huyện Đông Hưng",
                "province_id" => "34",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "341",
                "name" => "Huyện Thái Thụy",
                "province_id" => "34",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "342",
                "name" => "Huyện Tiền Hải",
                "province_id" => "34",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "343",
                "name" => "Huyện Kiến Xương",
                "province_id" => "34",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "344",
                "name" => "Huyện Vũ Thư",
                "province_id" => "34",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "347",
                "name" => "Thành phố Phủ Lý",
                "province_id" => "35",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "349",
                "name" => "Thị xã Duy Tiên",
                "province_id" => "35",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "350",
                "name" => "Huyện Kim Bảng",
                "province_id" => "35",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "351",
                "name" => "Huyện Thanh Liêm",
                "province_id" => "35",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "352",
                "name" => "Huyện Bình Lục",
                "province_id" => "35",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "353",
                "name" => "Huyện Lý Nhân",
                "province_id" => "35",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "356",
                "name" => "Thành phố Nam Định",
                "province_id" => "36",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "358",
                "name" => "Huyện Mỹ Lộc",
                "province_id" => "36",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "359",
                "name" => "Huyện Vụ Bản",
                "province_id" => "36",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "360",
                "name" => "Huyện Ý Yên",
                "province_id" => "36",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "361",
                "name" => "Huyện Nghĩa Hưng",
                "province_id" => "36",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "362",
                "name" => "Huyện Nam Trực",
                "province_id" => "36",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "363",
                "name" => "Huyện Trực Ninh",
                "province_id" => "36",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "364",
                "name" => "Huyện Xuân Trường",
                "province_id" => "36",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "365",
                "name" => "Huyện Giao Thủy",
                "province_id" => "36",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "366",
                "name" => "Huyện Hải Hậu",
                "province_id" => "36",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "369",
                "name" => "Thành phố Ninh Bình",
                "province_id" => "37",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "370",
                "name" => "Thành phố Tam Điệp",
                "province_id" => "37",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "372",
                "name" => "Huyện Nho Quan",
                "province_id" => "37",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "373",
                "name" => "Huyện Gia Viễn",
                "province_id" => "37",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "374",
                "name" => "Huyện Hoa Lư",
                "province_id" => "37",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "375",
                "name" => "Huyện Yên Khánh",
                "province_id" => "37",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "376",
                "name" => "Huyện Kim Sơn",
                "province_id" => "37",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "377",
                "name" => "Huyện Yên Mô",
                "province_id" => "37",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "380",
                "name" => "Thành phố Thanh Hóa",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "381",
                "name" => "Thị xã Bỉm Sơn",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "382",
                "name" => "Thành phố Sầm Sơn",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "384",
                "name" => "Huyện Mường Lát",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "385",
                "name" => "Huyện Quan Hóa",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "386",
                "name" => "Huyện Bá Thước",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "387",
                "name" => "Huyện Quan Sơn",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "388",
                "name" => "Huyện Lang Chánh",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "389",
                "name" => "Huyện Ngọc Lặc",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "390",
                "name" => "Huyện Cẩm Thủy",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "391",
                "name" => "Huyện Thạch Thành",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "392",
                "name" => "Huyện Hà Trung",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "393",
                "name" => "Huyện Vĩnh Lộc",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "394",
                "name" => "Huyện Yên Định",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "395",
                "name" => "Huyện Thọ Xuân",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "396",
                "name" => "Huyện Thường Xuân",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "397",
                "name" => "Huyện Triệu Sơn",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "398",
                "name" => "Huyện Thiệu Hóa",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "399",
                "name" => "Huyện Hoằng Hóa",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "400",
                "name" => "Huyện Hậu Lộc",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "401",
                "name" => "Huyện Nga Sơn",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "402",
                "name" => "Huyện Như Xuân",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "403",
                "name" => "Huyện Như Thanh",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "404",
                "name" => "Huyện Nông Cống",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "405",
                "name" => "Huyện Đông Sơn",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "406",
                "name" => "Huyện Quảng Xương",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "407",
                "name" => "Thị xã Nghi Sơn",
                "province_id" => "38",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "412",
                "name" => "Thành phố Vinh",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "413",
                "name" => "Thị xã Cửa Lò",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "414",
                "name" => "Thị xã Thái Hoà",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "415",
                "name" => "Huyện Quế Phong",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "416",
                "name" => "Huyện Quỳ Châu",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "417",
                "name" => "Huyện Kỳ Sơn",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "418",
                "name" => "Huyện Tương Dương",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "419",
                "name" => "Huyện Nghĩa Đàn",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "420",
                "name" => "Huyện Quỳ Hợp",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "421",
                "name" => "Huyện Quỳnh Lưu",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "422",
                "name" => "Huyện Con Cuông",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "423",
                "name" => "Huyện Tân Kỳ",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "424",
                "name" => "Huyện Anh Sơn",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "425",
                "name" => "Huyện Diễn Châu",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "426",
                "name" => "Huyện Yên Thành",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "427",
                "name" => "Huyện Đô Lương",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "428",
                "name" => "Huyện Thanh Chương",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "429",
                "name" => "Huyện Nghi Lộc",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "430",
                "name" => "Huyện Nam Đàn",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "431",
                "name" => "Huyện Hưng Nguyên",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "432",
                "name" => "Thị xã Hoàng Mai",
                "province_id" => "40",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "436",
                "name" => "Thành phố Hà Tĩnh",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "437",
                "name" => "Thị xã Hồng Lĩnh",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "439",
                "name" => "Huyện Hương Sơn",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "440",
                "name" => "Huyện Đức Thọ",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "441",
                "name" => "Huyện Vũ Quang",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "442",
                "name" => "Huyện Nghi Xuân",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "443",
                "name" => "Huyện Can Lộc",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "444",
                "name" => "Huyện Hương Khê",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "445",
                "name" => "Huyện Thạch Hà",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "446",
                "name" => "Huyện Cẩm Xuyên",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "447",
                "name" => "Huyện Kỳ Anh",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "448",
                "name" => "Huyện Lộc Hà",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "449",
                "name" => "Thị xã Kỳ Anh",
                "province_id" => "42",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "450",
                "name" => "Thành Phố Đồng Hới",
                "province_id" => "44",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "452",
                "name" => "Huyện Minh Hóa",
                "province_id" => "44",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "453",
                "name" => "Huyện Tuyên Hóa",
                "province_id" => "44",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "454",
                "name" => "Huyện Quảng Trạch",
                "province_id" => "44",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "455",
                "name" => "Huyện Bố Trạch",
                "province_id" => "44",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "456",
                "name" => "Huyện Quảng Ninh",
                "province_id" => "44",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "457",
                "name" => "Huyện Lệ Thủy",
                "province_id" => "44",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "458",
                "name" => "Thị xã Ba Đồn",
                "province_id" => "44",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "461",
                "name" => "Thành phố Đông Hà",
                "province_id" => "45",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "462",
                "name" => "Thị xã Quảng Trị",
                "province_id" => "45",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "464",
                "name" => "Huyện Vĩnh Linh",
                "province_id" => "45",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "465",
                "name" => "Huyện Hướng Hóa",
                "province_id" => "45",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "466",
                "name" => "Huyện Gio Linh",
                "province_id" => "45",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "467",
                "name" => "Huyện Đa Krông",
                "province_id" => "45",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "468",
                "name" => "Huyện Cam Lộ",
                "province_id" => "45",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "469",
                "name" => "Huyện Triệu Phong",
                "province_id" => "45",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "470",
                "name" => "Huyện Hải Lăng",
                "province_id" => "45",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "471",
                "name" => "Huyện Cồn Cỏ",
                "province_id" => "45",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "474",
                "name" => "Thành phố Huế",
                "province_id" => "46",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "476",
                "name" => "Huyện Phong Điền",
                "province_id" => "46",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "477",
                "name" => "Huyện Quảng Điền",
                "province_id" => "46",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "478",
                "name" => "Huyện Phú Vang",
                "province_id" => "46",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "479",
                "name" => "Thị xã Hương Thủy",
                "province_id" => "46",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "480",
                "name" => "Thị xã Hương Trà",
                "province_id" => "46",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "481",
                "name" => "Huyện A Lưới",
                "province_id" => "46",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "482",
                "name" => "Huyện Phú Lộc",
                "province_id" => "46",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "483",
                "name" => "Huyện Nam Đông",
                "province_id" => "46",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "490",
                "name" => "Quận Liên Chiểu",
                "province_id" => "48",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "491",
                "name" => "Quận Thanh Khê",
                "province_id" => "48",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "492",
                "name" => "Quận Hải Châu",
                "province_id" => "48",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "493",
                "name" => "Quận Sơn Trà",
                "province_id" => "48",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "494",
                "name" => "Quận Ngũ Hành Sơn",
                "province_id" => "48",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "495",
                "name" => "Quận Cẩm Lệ",
                "province_id" => "48",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "497",
                "name" => "Huyện Hòa Vang",
                "province_id" => "48",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "498",
                "name" => "Huyện Hoàng Sa",
                "province_id" => "48",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "502",
                "name" => "Thành phố Tam Kỳ",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "503",
                "name" => "Thành phố Hội An",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "504",
                "name" => "Huyện Tây Giang",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "505",
                "name" => "Huyện Đông Giang",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "506",
                "name" => "Huyện Đại Lộc",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "507",
                "name" => "Thị xã Điện Bàn",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "508",
                "name" => "Huyện Duy Xuyên",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "509",
                "name" => "Huyện Quế Sơn",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "510",
                "name" => "Huyện Nam Giang",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "511",
                "name" => "Huyện Phước Sơn",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "512",
                "name" => "Huyện Hiệp Đức",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "513",
                "name" => "Huyện Thăng Bình",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "514",
                "name" => "Huyện Tiên Phước",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "515",
                "name" => "Huyện Bắc Trà My",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "516",
                "name" => "Huyện Nam Trà My",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "517",
                "name" => "Huyện Núi Thành",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "518",
                "name" => "Huyện Phú Ninh",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "519",
                "name" => "Huyện Nông Sơn",
                "province_id" => "49",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "522",
                "name" => "Thành phố Quảng Ngãi",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "524",
                "name" => "Huyện Bình Sơn",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "525",
                "name" => "Huyện Trà Bồng",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "527",
                "name" => "Huyện Sơn Tịnh",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "528",
                "name" => "Huyện Tư Nghĩa",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "529",
                "name" => "Huyện Sơn Hà",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "530",
                "name" => "Huyện Sơn Tây",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "531",
                "name" => "Huyện Minh Long",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "532",
                "name" => "Huyện Nghĩa Hành",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "533",
                "name" => "Huyện Mộ Đức",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "534",
                "name" => "Thị xã Đức Phổ",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "535",
                "name" => "Huyện Ba Tơ",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "536",
                "name" => "Huyện Lý Sơn",
                "province_id" => "51",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "540",
                "name" => "Thành phố Quy Nhơn",
                "province_id" => "52",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "542",
                "name" => "Huyện An Lão",
                "province_id" => "52",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "543",
                "name" => "Thị xã Hoài Nhơn",
                "province_id" => "52",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "544",
                "name" => "Huyện Hoài Ân",
                "province_id" => "52",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "545",
                "name" => "Huyện Phù Mỹ",
                "province_id" => "52",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "546",
                "name" => "Huyện Vĩnh Thạnh",
                "province_id" => "52",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "547",
                "name" => "Huyện Tây Sơn",
                "province_id" => "52",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "548",
                "name" => "Huyện Phù Cát",
                "province_id" => "52",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "549",
                "name" => "Thị xã An Nhơn",
                "province_id" => "52",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "550",
                "name" => "Huyện Tuy Phước",
                "province_id" => "52",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "551",
                "name" => "Huyện Vân Canh",
                "province_id" => "52",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "555",
                "name" => "Thành phố Tuy Hoà",
                "province_id" => "54",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "557",
                "name" => "Thị xã Sông Cầu",
                "province_id" => "54",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "558",
                "name" => "Huyện Đồng Xuân",
                "province_id" => "54",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "559",
                "name" => "Huyện Tuy An",
                "province_id" => "54",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "560",
                "name" => "Huyện Sơn Hòa",
                "province_id" => "54",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "561",
                "name" => "Huyện Sông Hinh",
                "province_id" => "54",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "562",
                "name" => "Huyện Tây Hoà",
                "province_id" => "54",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "563",
                "name" => "Huyện Phú Hoà",
                "province_id" => "54",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "564",
                "name" => "Thị xã Đông Hòa",
                "province_id" => "54",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "568",
                "name" => "Thành phố Nha Trang",
                "province_id" => "56",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "569",
                "name" => "Thành phố Cam Ranh",
                "province_id" => "56",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "570",
                "name" => "Huyện Cam Lâm",
                "province_id" => "56",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "571",
                "name" => "Huyện Vạn Ninh",
                "province_id" => "56",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "572",
                "name" => "Thị xã Ninh Hòa",
                "province_id" => "56",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "573",
                "name" => "Huyện Khánh Vĩnh",
                "province_id" => "56",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "574",
                "name" => "Huyện Diên Khánh",
                "province_id" => "56",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "575",
                "name" => "Huyện Khánh Sơn",
                "province_id" => "56",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "576",
                "name" => "Huyện Trường Sa",
                "province_id" => "56",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "582",
                "name" => "Thành phố Phan Rang-Tháp Chàm",
                "province_id" => "58",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "584",
                "name" => "Huyện Bác Ái",
                "province_id" => "58",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "585",
                "name" => "Huyện Ninh Sơn",
                "province_id" => "58",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "586",
                "name" => "Huyện Ninh Hải",
                "province_id" => "58",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "587",
                "name" => "Huyện Ninh Phước",
                "province_id" => "58",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "588",
                "name" => "Huyện Thuận Bắc",
                "province_id" => "58",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "589",
                "name" => "Huyện Thuận Nam",
                "province_id" => "58",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "593",
                "name" => "Thành phố Phan Thiết",
                "province_id" => "60",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "594",
                "name" => "Thị xã La Gi",
                "province_id" => "60",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "595",
                "name" => "Huyện Tuy Phong",
                "province_id" => "60",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "596",
                "name" => "Huyện Bắc Bình",
                "province_id" => "60",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "597",
                "name" => "Huyện Hàm Thuận Bắc",
                "province_id" => "60",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "598",
                "name" => "Huyện Hàm Thuận Nam",
                "province_id" => "60",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "599",
                "name" => "Huyện Tánh Linh",
                "province_id" => "60",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "600",
                "name" => "Huyện Đức Linh",
                "province_id" => "60",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "601",
                "name" => "Huyện Hàm Tân",
                "province_id" => "60",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "602",
                "name" => "Huyện Phú Quí",
                "province_id" => "60",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "608",
                "name" => "Thành phố Kon Tum",
                "province_id" => "62",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "610",
                "name" => "Huyện Đắk Glei",
                "province_id" => "62",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "611",
                "name" => "Huyện Ngọc Hồi",
                "province_id" => "62",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "612",
                "name" => "Huyện Đắk Tô",
                "province_id" => "62",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "613",
                "name" => "Huyện Kon Plông",
                "province_id" => "62",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "614",
                "name" => "Huyện Kon Rẫy",
                "province_id" => "62",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "615",
                "name" => "Huyện Đắk Hà",
                "province_id" => "62",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "616",
                "name" => "Huyện Sa Thầy",
                "province_id" => "62",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "617",
                "name" => "Huyện Tu Mơ Rông",
                "province_id" => "62",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "618",
                "name" => "Huyện Ia H' Drai",
                "province_id" => "62",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "622",
                "name" => "Thành phố Pleiku",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "623",
                "name" => "Thị xã An Khê",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "624",
                "name" => "Thị xã Ayun Pa",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "625",
                "name" => "Huyện KBang",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "626",
                "name" => "Huyện Đăk Đoa",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "627",
                "name" => "Huyện Chư Păh",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "628",
                "name" => "Huyện Ia Grai",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "629",
                "name" => "Huyện Mang Yang",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "630",
                "name" => "Huyện Kông Chro",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "631",
                "name" => "Huyện Đức Cơ",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "632",
                "name" => "Huyện Chư Prông",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "633",
                "name" => "Huyện Chư Sê",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "634",
                "name" => "Huyện Đăk Pơ",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "635",
                "name" => "Huyện Ia Pa",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "637",
                "name" => "Huyện Krông Pa",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "638",
                "name" => "Huyện Phú Thiện",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "639",
                "name" => "Huyện Chư Pưh",
                "province_id" => "64",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "643",
                "name" => "Thành phố Buôn Ma Thuột",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "644",
                "name" => "Thị xã Buôn Hồ",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "645",
                "name" => "Huyện Ea H'leo",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "646",
                "name" => "Huyện Ea Súp",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "647",
                "name" => "Huyện Buôn Đôn",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "648",
                "name" => "Huyện Cư M'gar",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "649",
                "name" => "Huyện Krông Búk",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "650",
                "name" => "Huyện Krông Năng",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "651",
                "name" => "Huyện Ea Kar",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "652",
                "name" => "Huyện M'Đrắk",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "653",
                "name" => "Huyện Krông Bông",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "654",
                "name" => "Huyện Krông Pắc",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "655",
                "name" => "Huyện Krông A Na",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "656",
                "name" => "Huyện Lắk",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "657",
                "name" => "Huyện Cư Kuin",
                "province_id" => "66",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "660",
                "name" => "Thành phố Gia Nghĩa",
                "province_id" => "67",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "661",
                "name" => "Huyện Đăk Glong",
                "province_id" => "67",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "662",
                "name" => "Huyện Cư Jút",
                "province_id" => "67",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "663",
                "name" => "Huyện Đắk Mil",
                "province_id" => "67",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "664",
                "name" => "Huyện Krông Nô",
                "province_id" => "67",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "665",
                "name" => "Huyện Đắk Song",
                "province_id" => "67",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "666",
                "name" => "Huyện Đắk R'Lấp",
                "province_id" => "67",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "667",
                "name" => "Huyện Tuy Đức",
                "province_id" => "67",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "672",
                "name" => "Thành phố Đà Lạt",
                "province_id" => "68",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "673",
                "name" => "Thành phố Bảo Lộc",
                "province_id" => "68",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "674",
                "name" => "Huyện Đam Rông",
                "province_id" => "68",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "675",
                "name" => "Huyện Lạc Dương",
                "province_id" => "68",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "676",
                "name" => "Huyện Lâm Hà",
                "province_id" => "68",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "677",
                "name" => "Huyện Đơn Dương",
                "province_id" => "68",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "678",
                "name" => "Huyện Đức Trọng",
                "province_id" => "68",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "679",
                "name" => "Huyện Di Linh",
                "province_id" => "68",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "680",
                "name" => "Huyện Bảo Lâm",
                "province_id" => "68",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "681",
                "name" => "Huyện Đạ Huoai",
                "province_id" => "68",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "682",
                "name" => "Huyện Đạ Tẻh",
                "province_id" => "68",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "683",
                "name" => "Huyện Cát Tiên",
                "province_id" => "68",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "688",
                "name" => "Thị xã Phước Long",
                "province_id" => "70",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "689",
                "name" => "Thành phố Đồng Xoài",
                "province_id" => "70",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "690",
                "name" => "Thị xã Bình Long",
                "province_id" => "70",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "691",
                "name" => "Huyện Bù Gia Mập",
                "province_id" => "70",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "692",
                "name" => "Huyện Lộc Ninh",
                "province_id" => "70",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "693",
                "name" => "Huyện Bù Đốp",
                "province_id" => "70",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "694",
                "name" => "Huyện Hớn Quản",
                "province_id" => "70",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "695",
                "name" => "Huyện Đồng Phú",
                "province_id" => "70",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "696",
                "name" => "Huyện Bù Đăng",
                "province_id" => "70",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "697",
                "name" => "Thị xã Chơn Thành",
                "province_id" => "70",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "698",
                "name" => "Huyện Phú Riềng",
                "province_id" => "70",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "703",
                "name" => "Thành phố Tây Ninh",
                "province_id" => "72",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "705",
                "name" => "Huyện Tân Biên",
                "province_id" => "72",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "706",
                "name" => "Huyện Tân Châu",
                "province_id" => "72",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "707",
                "name" => "Huyện Dương Minh Châu",
                "province_id" => "72",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "708",
                "name" => "Huyện Châu Thành",
                "province_id" => "72",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "709",
                "name" => "Thị xã Hòa Thành",
                "province_id" => "72",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "710",
                "name" => "Huyện Gò Dầu",
                "province_id" => "72",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "711",
                "name" => "Huyện Bến Cầu",
                "province_id" => "72",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "712",
                "name" => "Thị xã Trảng Bàng",
                "province_id" => "72",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "718",
                "name" => "Thành phố Thủ Dầu Một",
                "province_id" => "74",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "719",
                "name" => "Huyện Bàu Bàng",
                "province_id" => "74",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "720",
                "name" => "Huyện Dầu Tiếng",
                "province_id" => "74",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "721",
                "name" => "Thị xã Bến Cát",
                "province_id" => "74",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "722",
                "name" => "Huyện Phú Giáo",
                "province_id" => "74",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "723",
                "name" => "Thành phố Tân Uyên",
                "province_id" => "74",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "724",
                "name" => "Thành phố Dĩ An",
                "province_id" => "74",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "725",
                "name" => "Thành phố Thuận An",
                "province_id" => "74",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "726",
                "name" => "Huyện Bắc Tân Uyên",
                "province_id" => "74",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "731",
                "name" => "Thành phố Biên Hòa",
                "province_id" => "75",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "732",
                "name" => "Thành phố Long Khánh",
                "province_id" => "75",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "734",
                "name" => "Huyện Tân Phú",
                "province_id" => "75",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "735",
                "name" => "Huyện Vĩnh Cửu",
                "province_id" => "75",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "736",
                "name" => "Huyện Định Quán",
                "province_id" => "75",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "737",
                "name" => "Huyện Trảng Bom",
                "province_id" => "75",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "738",
                "name" => "Huyện Thống Nhất",
                "province_id" => "75",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "739",
                "name" => "Huyện Cẩm Mỹ",
                "province_id" => "75",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "740",
                "name" => "Huyện Long Thành",
                "province_id" => "75",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "741",
                "name" => "Huyện Xuân Lộc",
                "province_id" => "75",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "742",
                "name" => "Huyện Nhơn Trạch",
                "province_id" => "75",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "747",
                "name" => "Thành phố Vũng Tàu",
                "province_id" => "77",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "748",
                "name" => "Thành phố Bà Rịa",
                "province_id" => "77",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "750",
                "name" => "Huyện Châu Đức",
                "province_id" => "77",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "751",
                "name" => "Huyện Xuyên Mộc",
                "province_id" => "77",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "752",
                "name" => "Huyện Long Điền",
                "province_id" => "77",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "753",
                "name" => "Huyện Đất Đỏ",
                "province_id" => "77",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "754",
                "name" => "Thị xã Phú Mỹ",
                "province_id" => "77",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "755",
                "name" => "Huyện Côn Đảo",
                "province_id" => "77",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "760",
                "name" => "Quận 1",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "761",
                "name" => "Quận 12",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "764",
                "name" => "Quận Gò Vấp",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "765",
                "name" => "Quận Bình Thạnh",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "766",
                "name" => "Quận Tân Bình",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "767",
                "name" => "Quận Tân Phú",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "768",
                "name" => "Quận Phú Nhuận",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "769",
                "name" => "Thành phố Thủ Đức",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "770",
                "name" => "Quận 3",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "771",
                "name" => "Quận 10",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "772",
                "name" => "Quận 11",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "773",
                "name" => "Quận 4",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "774",
                "name" => "Quận 5",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "775",
                "name" => "Quận 6",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "776",
                "name" => "Quận 8",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "777",
                "name" => "Quận Bình Tân",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "778",
                "name" => "Quận 7",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "783",
                "name" => "Huyện Củ Chi",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "784",
                "name" => "Huyện Hóc Môn",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "785",
                "name" => "Huyện Bình Chánh",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "786",
                "name" => "Huyện Nhà Bè",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "787",
                "name" => "Huyện Cần Giờ",
                "province_id" => "79",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "794",
                "name" => "Thành phố Tân An",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "795",
                "name" => "Thị xã Kiến Tường",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "796",
                "name" => "Huyện Tân Hưng",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "797",
                "name" => "Huyện Vĩnh Hưng",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "798",
                "name" => "Huyện Mộc Hóa",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "799",
                "name" => "Huyện Tân Thạnh",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "800",
                "name" => "Huyện Thạnh Hóa",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "801",
                "name" => "Huyện Đức Huệ",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "802",
                "name" => "Huyện Đức Hòa",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "803",
                "name" => "Huyện Bến Lức",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "804",
                "name" => "Huyện Thủ Thừa",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "805",
                "name" => "Huyện Tân Trụ",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "806",
                "name" => "Huyện Cần Đước",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "807",
                "name" => "Huyện Cần Giuộc",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "808",
                "name" => "Huyện Châu Thành",
                "province_id" => "80",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "815",
                "name" => "Thành phố Mỹ Tho",
                "province_id" => "82",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "816",
                "name" => "Thị xã Gò Công",
                "province_id" => "82",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "817",
                "name" => "Thị xã Cai Lậy",
                "province_id" => "82",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "818",
                "name" => "Huyện Tân Phước",
                "province_id" => "82",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "819",
                "name" => "Huyện Cái Bè",
                "province_id" => "82",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "820",
                "name" => "Huyện Cai Lậy",
                "province_id" => "82",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "821",
                "name" => "Huyện Châu Thành",
                "province_id" => "82",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "822",
                "name" => "Huyện Chợ Gạo",
                "province_id" => "82",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "823",
                "name" => "Huyện Gò Công Tây",
                "province_id" => "82",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "824",
                "name" => "Huyện Gò Công Đông",
                "province_id" => "82",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "825",
                "name" => "Huyện Tân Phú Đông",
                "province_id" => "82",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "829",
                "name" => "Thành phố Bến Tre",
                "province_id" => "83",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "831",
                "name" => "Huyện Châu Thành",
                "province_id" => "83",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "832",
                "name" => "Huyện Chợ Lách",
                "province_id" => "83",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "833",
                "name" => "Huyện Mỏ Cày Nam",
                "province_id" => "83",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "834",
                "name" => "Huyện Giồng Trôm",
                "province_id" => "83",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "835",
                "name" => "Huyện Bình Đại",
                "province_id" => "83",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "836",
                "name" => "Huyện Ba Tri",
                "province_id" => "83",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "837",
                "name" => "Huyện Thạnh Phú",
                "province_id" => "83",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "838",
                "name" => "Huyện Mỏ Cày Bắc",
                "province_id" => "83",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "842",
                "name" => "Thành phố Trà Vinh",
                "province_id" => "84",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "844",
                "name" => "Huyện Càng Long",
                "province_id" => "84",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "845",
                "name" => "Huyện Cầu Kè",
                "province_id" => "84",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "846",
                "name" => "Huyện Tiểu Cần",
                "province_id" => "84",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "847",
                "name" => "Huyện Châu Thành",
                "province_id" => "84",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "848",
                "name" => "Huyện Cầu Ngang",
                "province_id" => "84",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "849",
                "name" => "Huyện Trà Cú",
                "province_id" => "84",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "850",
                "name" => "Huyện Duyên Hải",
                "province_id" => "84",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "851",
                "name" => "Thị xã Duyên Hải",
                "province_id" => "84",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "855",
                "name" => "Thành phố Vĩnh Long",
                "province_id" => "86",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "857",
                "name" => "Huyện Long Hồ",
                "province_id" => "86",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "858",
                "name" => "Huyện Mang Thít",
                "province_id" => "86",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "859",
                "name" => "Huyện Vũng Liêm",
                "province_id" => "86",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "860",
                "name" => "Huyện Tam Bình",
                "province_id" => "86",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "861",
                "name" => "Thị xã Bình Minh",
                "province_id" => "86",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "862",
                "name" => "Huyện Trà Ôn",
                "province_id" => "86",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "863",
                "name" => "Huyện Bình Tân",
                "province_id" => "86",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "866",
                "name" => "Thành phố Cao Lãnh",
                "province_id" => "87",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "867",
                "name" => "Thành phố Sa Đéc",
                "province_id" => "87",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "868",
                "name" => "Thành phố Hồng Ngự",
                "province_id" => "87",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "869",
                "name" => "Huyện Tân Hồng",
                "province_id" => "87",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "870",
                "name" => "Huyện Hồng Ngự",
                "province_id" => "87",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "871",
                "name" => "Huyện Tam Nông",
                "province_id" => "87",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "872",
                "name" => "Huyện Tháp Mười",
                "province_id" => "87",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "873",
                "name" => "Huyện Cao Lãnh",
                "province_id" => "87",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "874",
                "name" => "Huyện Thanh Bình",
                "province_id" => "87",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "875",
                "name" => "Huyện Lấp Vò",
                "province_id" => "87",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "876",
                "name" => "Huyện Lai Vung",
                "province_id" => "87",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "877",
                "name" => "Huyện Châu Thành",
                "province_id" => "87",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "883",
                "name" => "Thành phố Long Xuyên",
                "province_id" => "89",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "884",
                "name" => "Thành phố Châu Đốc",
                "province_id" => "89",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "886",
                "name" => "Huyện An Phú",
                "province_id" => "89",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "887",
                "name" => "Thị xã Tân Châu",
                "province_id" => "89",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "888",
                "name" => "Huyện Phú Tân",
                "province_id" => "89",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "889",
                "name" => "Huyện Châu Phú",
                "province_id" => "89",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "890",
                "name" => "Thị xã Tịnh Biên",
                "province_id" => "89",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "891",
                "name" => "Huyện Tri Tôn",
                "province_id" => "89",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "892",
                "name" => "Huyện Châu Thành",
                "province_id" => "89",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "893",
                "name" => "Huyện Chợ Mới",
                "province_id" => "89",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "894",
                "name" => "Huyện Thoại Sơn",
                "province_id" => "89",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "899",
                "name" => "Thành phố Rạch Giá",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "900",
                "name" => "Thành phố Hà Tiên",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "902",
                "name" => "Huyện Kiên Lương",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "903",
                "name" => "Huyện Hòn Đất",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "904",
                "name" => "Huyện Tân Hiệp",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "905",
                "name" => "Huyện Châu Thành",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "906",
                "name" => "Huyện Giồng Riềng",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "907",
                "name" => "Huyện Gò Quao",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "908",
                "name" => "Huyện An Biên",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "909",
                "name" => "Huyện An Minh",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "910",
                "name" => "Huyện Vĩnh Thuận",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "911",
                "name" => "Thành phố Phú Quốc",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "912",
                "name" => "Huyện Kiên Hải",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "913",
                "name" => "Huyện U Minh Thượng",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "914",
                "name" => "Huyện Giang Thành",
                "province_id" => "91",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "916",
                "name" => "Quận Ninh Kiều",
                "province_id" => "92",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "917",
                "name" => "Quận Ô Môn",
                "province_id" => "92",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "918",
                "name" => "Quận Bình Thuỷ",
                "province_id" => "92",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "919",
                "name" => "Quận Cái Răng",
                "province_id" => "92",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "923",
                "name" => "Quận Thốt Nốt",
                "province_id" => "92",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "924",
                "name" => "Huyện Vĩnh Thạnh",
                "province_id" => "92",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "925",
                "name" => "Huyện Cờ Đỏ",
                "province_id" => "92",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "926",
                "name" => "Huyện Phong Điền",
                "province_id" => "92",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "927",
                "name" => "Huyện Thới Lai",
                "province_id" => "92",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "930",
                "name" => "Thành phố Vị Thanh",
                "province_id" => "93",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "931",
                "name" => "Thành phố Ngã Bảy",
                "province_id" => "93",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "932",
                "name" => "Huyện Châu Thành A",
                "province_id" => "93",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "933",
                "name" => "Huyện Châu Thành",
                "province_id" => "93",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "934",
                "name" => "Huyện Phụng Hiệp",
                "province_id" => "93",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "935",
                "name" => "Huyện Vị Thuỷ",
                "province_id" => "93",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "936",
                "name" => "Huyện Long Mỹ",
                "province_id" => "93",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "937",
                "name" => "Thị xã Long Mỹ",
                "province_id" => "93",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "941",
                "name" => "Thành phố Sóc Trăng",
                "province_id" => "94",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "942",
                "name" => "Huyện Châu Thành",
                "province_id" => "94",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "943",
                "name" => "Huyện Kế Sách",
                "province_id" => "94",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "944",
                "name" => "Huyện Mỹ Tú",
                "province_id" => "94",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "945",
                "name" => "Huyện Cù Lao Dung",
                "province_id" => "94",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "946",
                "name" => "Huyện Long Phú",
                "province_id" => "94",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "947",
                "name" => "Huyện Mỹ Xuyên",
                "province_id" => "94",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "948",
                "name" => "Thị xã Ngã Năm",
                "province_id" => "94",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "949",
                "name" => "Huyện Thạnh Trị",
                "province_id" => "94",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "950",
                "name" => "Thị xã Vĩnh Châu",
                "province_id" => "94",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "951",
                "name" => "Huyện Trần Đề",
                "province_id" => "94",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "954",
                "name" => "Thành phố Bạc Liêu",
                "province_id" => "95",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "956",
                "name" => "Huyện Hồng Dân",
                "province_id" => "95",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "957",
                "name" => "Huyện Phước Long",
                "province_id" => "95",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "958",
                "name" => "Huyện Vĩnh Lợi",
                "province_id" => "95",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "959",
                "name" => "Thị xã Giá Rai",
                "province_id" => "95",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "960",
                "name" => "Huyện Đông Hải",
                "province_id" => "95",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "961",
                "name" => "Huyện Hoà Bình",
                "province_id" => "95",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "964",
                "name" => "Thành phố Cà Mau",
                "province_id" => "96",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "966",
                "name" => "Huyện U Minh",
                "province_id" => "96",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "967",
                "name" => "Huyện Thới Bình",
                "province_id" => "96",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "968",
                "name" => "Huyện Trần Văn Thời",
                "province_id" => "96",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "969",
                "name" => "Huyện Cái Nước",
                "province_id" => "96",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "970",
                "name" => "Huyện Đầm Dơi",
                "province_id" => "96",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "971",
                "name" => "Huyện Năm Căn",
                "province_id" => "96",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "972",
                "name" => "Huyện Phú Tân",
                "province_id" => "96",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ],
            [
                "id" => "973",
                "name" => "Huyện Ngọc Hiển",
                "province_id" => "96",
                'created_at' => $currentTimestamp, 
                'updated_at' => $currentTimestamp
            ]
        ];
        
        District::insert($districts);
    }
}
