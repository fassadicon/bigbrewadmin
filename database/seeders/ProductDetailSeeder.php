<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Milktea
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'okinawa',
            'description' => 'test',

            'image_path' => 'products/OKINAWA.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'wintermelon',
            'description' => 'test',
            'image_path' => 'products/WINTERMELON.jpeg'
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'red velvet',
            'description' => 'test',
            'image_path' => 'products/REDVELVET.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'matcha',
            'description' => 'test',
            'image_path' => 'products/MATCHA.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'double dutch',
            'description' => 'test',
            'image_path' => 'products/DOUBLEDUTCH.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'cheesecake',
            'description' => 'test',
            'image_path' => 'products/CHEESECAKE.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'dark choco',
            'description' => 'test',
            'image_path' => 'products/DARKCHOCO.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'chocolate',
            'description' => 'test',
            'image_path' => 'products/CHOCOLATE.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'salted caramel',
            'description' => 'test',
            'image_path' => 'products/SALTEDCARAMEL.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'cookies & cream',
            'description' => 'test',
            'image_path' => 'products/COOKIES AND CREAM.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'taro',
            'description' => 'test',
            'image_path' => 'products/TARO.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 1,
            'name' => 'strawberry',
            'description' => 'test',
            'image_path' => 'products/STRAWBERRY.jpg'

        ]);
        ProductDetail::create([
            'category_id' => 2,
            'name' => 'kiwi',
            'description' => 'test',
            'image_path' => 'products/KIWI.jpg'
        ]);

        ProductDetail::create([
            'category_id' => 2,
            'name' => 'lychee',
            'description' => 'test',
            'image_path' => 'products/LYCHEE.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 2,
            'name' => 'green apple',
            'description' => 'test',
            'image_path' => 'products/GREENAPPLE.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 2,
            'name' => 'lemon',
            'description' => 'test',
            'image_path' => 'products/LEMON.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 2,
            'name' => 'honey peach',
            'description' => 'test',
            'image_path' => 'products/HONEYPEACH.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 2,
            'name' => 'mango',
            'description' => 'test',
            'image_path' => 'products/MANGO.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 2,
            'name' => 'blueberry',
            'description' => 'test',
            'image_path' => 'products/BLUEBERRY.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 2,
            'name' => 'strawberry',
            'description' => 'test',
            'image_path' => 'products/STRAWBERRYFRUIT.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 3,
            'name' => 'Hot brusko',
            'description' => 'test',
            'image_path' => 'products/BRUSKO.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 3,
            'name' => 'Hot choco',
            'description' => 'test',
            'image_path' => 'products/BRUSKO.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 3,
            'name' => 'Hot Moca',
            'description' => 'test',
            'image_path' => 'products/BRUSKO.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 3,
            'name' => 'Hot Matcha',
            'description' => 'test',
            'image_path' => 'products/BRUSKO.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 3,
            'name' => 'Hot karamel',
            'description' => 'test',
            'image_path' => 'products/BRUSKO.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 4,
            'name' => 'Kape brusko',
            'description' => 'test',
            'image_path' => 'products/KAPEBRUSKO.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 4,
            'name' => 'Kape Macch',
            'description' => 'test',
            'image_path' => 'products/KAPE MACCH.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 4,
            'name' => 'Kape Moca',
            'description' => 'test',
            'image_path' => 'products/KAPEMOCA.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 4,
            'name' => 'Kape vanilla',
            'description' => 'test',
            'image_path' => 'products/KAPEVANILLA.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 4,
            'name' => 'Kape fudge',
            'description' => 'test',
            'image_path' => 'products/KAPEFUDGE.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 4,
            'name' => 'Kape matcha',
            'description' => 'test',
            'image_path' => 'products/MATCHA.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 4,
            'name' => 'Kape karamel',
            'description' => 'test',
            'image_path' => 'products/KAPEKARAMEL.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 5,
            'name' => 'moca',
            'description' => 'test',
            'image_path' => 'products/MOCAFRAP.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 5,
            'name' => 'coffee jelly',
            'description' => 'test',
            'image_path' => 'products/COFFEEJELLY.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 5,
            'name' => 'caramel macch',
            'description' => 'test',
            'image_path' => 'products/CARAMELMACCH.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 5,
            'name' => 'vanilla coffee',
            'description' => 'test',
            'image_path' => 'products/VANILLAFRAP.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 5,
            'name' => 'Cookies and cream',
            'description' => 'test',
            'image_path' => 'products/COOKIES AND CREAM PRAF.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 5,
            'name' => 'cheesecake cream',
            'description' => 'test',
            'image_path' => 'products/CHEESECAKE.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 5,
            'name' => 'taro cream',
            'description' => 'test',
            'image_path' => 'products/TAROCREAM.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 5,
            'name' => 'matcha cream',
            'description' => 'test',
            'image_path' => 'products/MACHACREAM.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 5,
            'name' => 'chocolate cream',
            'description' => 'test',
            'image_path' => 'products/CHOCOLATECREAM.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 5,
            'name' => 'strawberry cream',
            'description' => 'test',
            'image_path' => 'products/STRAWBERRYCREAM.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 6,
            'name' => 'Pearl',
            'description' => 'test',
            'image_path' => 'products/PEARL.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 6,
            'name' => 'Crystal',
            'description' => 'test',
            'image_path' => 'products/CRYSTAL.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 6,
            'name' => 'Cream cheese',
            'description' => 'test',
            'image_path' => 'products/CREAMCHEESE.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 6,
            'name' => 'Coffee jelly',
            'description' => 'test',
            'image_path' => 'products/COFFEEJELLYADDON.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 6,
            'name' => 'cream puff',
            'description' => 'test',
            'image_path' => 'products/CREAMPUFF.jpg'
        ]);
        ProductDetail::create([
            'category_id' => 6,
            'name' => 'cheesecake',
            'description' => 'test',
            'image_path' => 'products/CHEESECAKE ADDON.jpg'
        ]);
    }
}
