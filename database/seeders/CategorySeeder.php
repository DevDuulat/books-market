<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $categories = [
            'Көркөм Адабият',       // Художественная литература
            'Окуу Китептери',       // Учебники
            'Илимий Китептер',      // Научные книги
            'Балдар Адабияты',      // Детская литература
            'Фантастика',           // Фантастика
            'Поэзия жана Драма',    // Поэзия и Драма
            'Тарыхый Китептер',      // Исторические книги
            'Биографиялар',         // Биографии
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }
    }
}