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
                    'ua' => 'Екскурсія',
                    'en' => 'Excursion',
                    'ru' => 'Экскурсия',
                ],
            ],
            [
                'name' => [
                    'ua' => 'Відпочинок',
                    'en' => 'Vacation',
                    'ru' => 'Отдых',
                ]
            ],
            [
                'name' => [
                    'ua' => 'Третя',
                    'en' => 'Third',
                    'ru' => 'Третья',
                ]
            ],
        ];

        foreach ($categories as $key => $value) {
            Category::create($value);
        }

        Category::factory(10)->create();

    }
}
