<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Nhạc trẻ',
            'thumbnail' => 'https://photo-zmp3.zadn.vn/cover/1/e/0/f/1e0f4998259f2f8a0ae7de1a7110bb62.jpg'
        ]);

        Category::create([
            'name' => 'Nhạc trữ tình',
            'thumbnail' => 'https://photo-zmp3.zadn.vn/cover/a/f/6/4/af645626969f1838e60817ef208b1637.jpg'
        ]);

        Category::create([
            'name' => 'Nhạc Hàn Quốc',
            'thumbnail' => 'https://photo-zmp3.zadn.vn/cover/a/e/d/3/aed3d129c85c532fbef3c5571bfed4c0.jpg'
        ]);

        Category::create([
            'name' => 'Nhạc Nhật Bản',
            'thumbnail' => 'https://photo-zmp3.zadn.vn/banner/6/d/6d4b0b47ff2480010938e0befdd0a5bc_1474890571.jpg'
        ]);
    }
}
