<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Nhạc trẻ'
        ]);

        Category::create([
            'name' => 'Nhạc trữ tình'
        ]);

        Category::create([
            'name' => 'Nhạc Hàn Quốc'
        ]);

        Category::create([
            'name' => 'Nhạc Nhật Bản'
        ]);
    }
}
