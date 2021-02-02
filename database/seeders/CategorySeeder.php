<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => [
                    'ua' => 'екскурсія',
                    'en' => 'excursion',
                    'ru' => 'экскурсия',
                ],
            ],
            [
                'name' => [
                    'ua' => 'відпочинок',
                    'en' => 'vacation',
                    'ru' => 'отдых',
                ]
            ],
        ];

        foreach ($categories as $key => $value) {
            Category::create($value);
        }
    }
}