<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $categories = Category::all();

        Storage::disk('public')->makeDirectory('products');

        foreach ($categories as $category) {
            $count = rand(7, 8);

            for ($i = 0; $i < $count; $i++) {
                $name = $faker->words(3, true);

                $fileName = 'products/' . Str::random(10) . '.png';
                $url = 'https://placehold.co/600x400/png?text=' . urlencode($name);
                $imageContents = file_get_contents($url);
                Storage::disk('public')->put($fileName, $imageContents);

                Product::create([
                    'name'        => ucfirst($name),
                    'slug'        => Str::slug($name . '-' . Str::random(5)),
                    'image'       => $fileName,
                    'images'      => [
                        $fileName,
                        $fileName
                    ],
                    'description' => substr($faker->paragraph(2), 0, 1000),
                    'price'       => $faker->numberBetween(3000, 20000),
                    'discount'    => $faker->optional(0.4)->numberBetween(200, 2000),
                    'quantity'    => $faker->numberBetween(1, 120),
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
