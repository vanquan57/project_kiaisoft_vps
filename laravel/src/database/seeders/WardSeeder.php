<?php

namespace Database\Seeders;

use App\Models\Ward;
use Illuminate\Database\Seeder;

class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wards = [
            [
                'id' => '19330',
                'name' => 'Phường Đông Giang',
                'district_id' => '461',
            ],
            [
                'id' => '19333',
                'name' => 'Phường 1',
                'district_id' => '461',
            ],
            [
                'id' => '19336',
                'name' => 'Phường Đông Lễ',
                'district_id' => '461',
            ],
            [
                'id' => '19339',
                'name' => 'Phường Đông Thanh',
                'district_id' => '461',
            ],
            [
                'id' => '19342',
                'name' => 'Phường 2',
                'district_id' => '461',
            ],
            [
                'id' => '19345',
                'name' => 'Phường 4',
                'district_id' => '461',
            ],
            [
                'id' => '19348',
                'name' => 'Phường 5',
                'district_id' => '461',
            ],
            [
                'id' => '19351',
                'name' => 'Phường Đông Lương',
                'district_id' => '461',
            ],
            [
                'id' => '19354',
                'name' => 'Phường 3',
                'district_id' => '461',
            ],
            [
                'id' => '19357',
                'name' => 'Phường 1',
                'district_id' => '462',
            ],
            [
                'id' => '19358',
                'name' => 'Phường An Đôn',
                'district_id' => '462',
            ],
            [
                'id' => '19360',
                'name' => 'Phường 2',
                'district_id' => '462',
            ],
            [
                'id' => '19361',
                'name' => 'Phường 3',
                'district_id' => '462',
            ],
            [
                'id' => '19705',
                'name' => 'Xã Hải Lệ',
                'district_id' => '462',
            ],
            [
                'id' => '19363',
                'name' => 'Thị trấn Hồ Xá',
                'district_id' => '464',
            ],
            [
                'id' => '19366',
                'name' => 'Thị trấn Bến Quan',
                'district_id' => '464',
            ],
            [
                'id' => '19369',
                'name' => 'Xã Vĩnh Thái',
                'district_id' => '464',
            ],
            [
                'id' => '19372',
                'name' => 'Xã Vĩnh Tú',
                'district_id' => '464',
            ],
            [
                'id' => '19375',
                'name' => 'Xã Vĩnh Chấp',
                'district_id' => '464',
            ],
            [
                'id' => '19378',
                'name' => 'Xã Trung Nam',
                'district_id' => '464',
            ],
            [
                'id' => '19384',
                'name' => 'Xã Kim Thạch',
                'district_id' => '464',
            ],
            [
                'id' => '19387',
                'name' => 'Xã Vĩnh Long',
                'district_id' => '464',
            ],
            [
                'id' => '19393',
                'name' => 'Xã Vĩnh Khê',
                'district_id' => '464',
            ],
            [
                'id' => '19396',
                'name' => 'Xã Vĩnh Hòa',
                'district_id' => '464',
            ],
            [
                'id' => '19402',
                'name' => 'Xã Vĩnh Thủy',
                'district_id' => '464',
            ],
            [
                'id' => '19405',
                'name' => 'Xã Vĩnh Lâm',
                'district_id' => '464',
            ],
            [
                'id' => '19408',
                'name' => 'Xã Hiền Thành',
                'district_id' => '464',
            ],
            [
                'id' => '19414',
                'name' => 'Thị trấn Cửa Tùng',
                'district_id' => '464',
            ],
            [
                'id' => '19417',
                'name' => 'Xã Vĩnh Hà',
                'district_id' => '464',
            ],
            [
                'id' => '19420',
                'name' => 'Xã Vĩnh Sơn',
                'district_id' => '464',
            ],
            [
                'id' => '19423',
                'name' => 'Xã Vĩnh Giang',
                'district_id' => '464',
            ],
            [
                'id' => '19426',
                'name' => 'Xã Vĩnh Ô',
                'district_id' => '464',
            ],
            [
                'id' => '19429',
                'name' => 'Thị trấn Khe Sanh',
                'district_id' => '465',
            ],
            [
                'id' => '19432',
                'name' => 'Thị trấn Lao Bảo',
                'district_id' => '465',
            ],
            [
                'id' => '19435',
                'name' => 'Xã Hướng Lập',
                'district_id' => '465',
            ],
            [
                'id' => '19438',
                'name' => 'Xã Hướng Việt',
                'district_id' => '465',
            ],
            [
                'id' => '19441',
                'name' => 'Xã Hướng Phùng',
                'district_id' => '465',
            ],
            [
                'id' => '19444',
                'name' => 'Xã Hướng Sơn',
                'district_id' => '465',
            ],
            [
                'id' => '19447',
                'name' => 'Xã Hướng Linh',
                'district_id' => '465',
            ],
            [
                'id' => '19450',
                'name' => 'Xã Tân Hợp',
                'district_id' => '465',
            ],
            [
                'id' => '19453',
                'name' => 'Xã Hướng Tân',
                'district_id' => '465',
            ],
            [
                'id' => '19456',
                'name' => 'Xã Tân Thành',
                'district_id' => '465',
            ],
            [
                'id' => '19459',
                'name' => 'Xã Tân Long',
                'district_id' => '465',
            ],
            [
                'id' => '19462',
                'name' => 'Xã Tân Lập',
                'district_id' => '465',
            ],
            [
                'id' => '19465',
                'name' => 'Xã Tân Liên',
                'district_id' => '465',
            ],
            [
                'id' => '19468',
                'name' => 'Xã Húc',
                'district_id' => '465',
            ],
            [
                'id' => '19471',
                'name' => 'Xã Thuận',
                'district_id' => '465',
            ],
            [
                'id' => '19474',
                'name' => 'Xã Hướng Lộc',
                'district_id' => '465',
            ],
            [
                'id' => '19477',
                'name' => 'Xã Ba Tầng',
                'district_id' => '465',
            ],
            [
                'id' => '19480',
                'name' => 'Xã Thanh',
                'district_id' => '465',
            ],
            [
                'id' => '19483',
                'name' => 'Xã A Dơi',
                'district_id' => '465',
            ],
            [
                'id' => '19489',
                'name' => 'Xã Lìa',
                'district_id' => '465',
            ],
            [
                'id' => '19492',
                'name' => 'Xã Xy',
                'district_id' => '465',
            ],
            [
                'id' => '19495',
                'name' => 'Thị trấn Gio Linh',
                'district_id' => '466',
            ],
            [
                'id' => '19496',
                'name' => 'Thị trấn Cửa Việt',
                'district_id' => '466',
            ],
            [
                'id' => '19498',
                'name' => 'Xã Trung Giang',
                'district_id' => '466',
            ],
            [
                'id' => '19501',
                'name' => 'Xã Trung Hải',
                'district_id' => '466',
            ],
            [
                'id' => '19504',
                'name' => 'Xã Trung Sơn',
                'district_id' => '466',
            ],
            [
                'id' => '19507',
                'name' => 'Xã Phong Bình',
                'district_id' => '466',
            ],
            [
                'id' => '19510',
                'name' => 'Xã Gio Mỹ',
                'district_id' => '466',
            ],
            [
                'id' => '19519',
                'name' => 'Xã Gio Hải',
                'district_id' => '466',
            ],
            [
                'id' => '19522',
                'name' => 'Xã Gio An',
                'district_id' => '466',
            ],
            [
                'id' => '19525',
                'name' => 'Xã Gio Châu',
                'district_id' => '466',
            ],
            [
                'id' => '19531',
                'name' => 'Xã Gio Việt',
                'district_id' => '466',
            ],
            [
                'id' => '19534',
                'name' => 'Xã Linh Trường',
                'district_id' => '466',
            ],
            [
                'id' => '19537',
                'name' => 'Xã Gio Sơn',
                'district_id' => '466',
            ],
            [
                'id' => '19543',
                'name' => 'Xã Gio Mai',
                'district_id' => '466',
            ],
            [
                'id' => '19546',
                'name' => 'Xã Hải Thái',
                'district_id' => '466',
            ],
            [
                'id' => '19549',
                'name' => 'Xã Linh Hải',
                'district_id' => '466',
            ],
            [
                'id' => '19552',
                'name' => 'Xã Gio Quang',
                'district_id' => '466',
            ],
            [
                'id' => '20227',
                'name' => 'Phường Thanh Bình',
                'district_id' => '492',
            ],
            [
                'id' => '20230',
                'name' => 'Phường Thuận Phước',
                'district_id' => '492',
            ],
            [
                'id' => '20233',
                'name' => 'Phường Thạch Thang',
                'district_id' => '492',
            ],
            [
                'id' => '20236',
                'name' => 'Phường Hải Châu I',
                'district_id' => '492',
            ],
            [
                'id' => '20239',
                'name' => 'Phường Hải Châu II',
                'district_id' => '492',
            ],
            [
                'id' => '20242',
                'name' => 'Phường Phước Ninh',
                'district_id' => '492',
            ],
            [
                'id' => '20245',
                'name' => 'Phường Hòa Thuận Tây',
                'district_id' => '492',
            ],
            [
                'id' => '20246',
                'name' => 'Phường Hòa Thuận Đông',
                'district_id' => '492',
            ],
            [
                'id' => '20248',
                'name' => 'Phường Nam Dương',
                'district_id' => '492',
            ],
            [
                'id' => '20251',
                'name' => 'Phường Bình Hiên',
                'district_id' => '492',
            ],
            [
                'id' => '20254',
                'name' => 'Phường Bình Thuận',
                'district_id' => '492',
            ],
            [
                'id' => '20257',
                'name' => 'Phường Hòa Cường Bắc',
                'district_id' => '492',
            ],
            [
                'id' => '20258',
                'name' => 'Phường Hòa Cường Nam',
                'district_id' => '492',
            ],
            [
                'id' => '20263',
                'name' => 'Phường Thọ Quang',
                'district_id' => '493',
            ],
            [
                'id' => '20266',
                'name' => 'Phường Nại Hiên Đông',
                'district_id' => '493',
            ],
            [
                'id' => '20269',
                'name' => 'Phường Mân Thái',
                'district_id' => '493',
            ],
            [
                'id' => '20272',
                'name' => 'Phường An Hải Bắc',
                'district_id' => '493',
            ],
            [
                'id' => '20275',
                'name' => 'Phường Phước Mỹ',
                'district_id' => '493',
            ],
            [
                'id' => '20278',
                'name' => 'Phường An Hải Tây',
                'district_id' => '493',
            ],
            [
                'id' => '20281',
                'name' => 'Phường An Hải Đông',
                'district_id' => '493',
            ],
            [
                'id' => '20284',
                'name' => 'Phường Mỹ An',
                'district_id' => '494',
            ],
            [
                'id' => '20285',
                'name' => 'Phường Khuê Mỹ',
                'district_id' => '494',
            ],
            [
                'id' => '20287',
                'name' => 'Phường Hoà Quý',
                'district_id' => '494',
            ],
            [
                'id' => '20290',
                'name' => 'Phường Hoà Hải',
                'district_id' => '494',
            ],
            [
                'id' => '20260',
                'name' => 'Phường Khuê Trung',
                'district_id' => '495',
            ],
            [
                'id' => '20305',
                'name' => 'Phường Hòa Phát',
                'district_id' => '495',
            ],
            [
                'id' => '20306',
                'name' => 'Phường Hòa An',
                'district_id' => '495',
            ],
            [
                'id' => '20311',
                'name' => 'Phường Hòa Thọ Tây',
                'district_id' => '495',
            ],
            [
                'id' => '20312',
                'name' => 'Phường Hòa Thọ Đông',
                'district_id' => '495',
            ],
            [
                'id' => '20314',
                'name' => 'Phường Hòa Xuân',
                'district_id' => '495',
            ],
            [
                'id' => '20293',
                'name' => 'Xã Hòa Bắc',
                'district_id' => '497',
            ],
            [
                'id' => '20296',
                'name' => 'Xã Hòa Liên',
                'district_id' => '497',
            ],
            [
                'id' => '20299',
                'name' => 'Xã Hòa Ninh',
                'district_id' => '497',
            ],
            [
                'id' => '20302',
                'name' => 'Xã Hòa Sơn',
                'district_id' => '497',
            ],
            [
                'id' => '20308',
                'name' => 'Xã Hòa Nhơn',
                'district_id' => '497',
            ],
            [
                'id' => '20317',
                'name' => 'Xã Hòa Phú',
                'district_id' => '497',
            ],
            [
                'id' => '20320',
                'name' => 'Xã Hòa Phong',
                'district_id' => '497',
            ],
            [
                'id' => '20323',
                'name' => 'Xã Hòa Châu',
                'district_id' => '497',
            ],
            [
                'id' => '20326',
                'name' => 'Xã Hòa Tiến',
                'district_id' => '497',
            ],
            [
                'id' => '20329',
                'name' => 'Xã Hòa Phước',
                'district_id' => '497',
            ],
            [
                'id' => '20332',
                'name' => 'Xã Hòa Khương',
                'district_id' => '497',
            ],

        ];

        foreach ($wards as $ward) {
            Ward::create($ward);
        }
    }
}
