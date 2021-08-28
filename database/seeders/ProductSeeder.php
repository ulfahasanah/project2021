<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        Product::insert([
            [
            'name' => 'Start With Why : How Great Leaders Inspire Everyone To Take Action',
            'unit' => 'pcs',
            'qty' => 23,
            'price' => 165000,
            'image_url' => 'https://d1w7fb2mkkr3kw.cloudfront.net/assets/images/book/lrg/9780/2419/9780241958223.jpg',
        ], [
            'name' => '7 Habits Of Highly Effective People',
            'unit' => 'pcs',
            'qty' => 40,
            'price' => 180000,
            'image_url' => 'https://d1w7fb2mkkr3kw.cloudfront.net/assets/images/book/lrg/9781/4165/9781416502494.jpg',
        ], [
            'name' => 'Thinking, Fast and Slow',
            'unit' => 'pcs',
            'qty' => 70,
            'price' => 207000,
            'image_url' => 'https://d1w7fb2mkkr3kw.cloudfront.net/assets/images/book/lrg/9780/1410/9780141033570.jpg',
        ], [
            'name' => 'The Power of Habit : Why We Do What We Do, and How to Change',
            'unit' => 'pcs',
            'qty' => 50,
            'price' => 141000,
            'image_url' => 'https://d1w7fb2mkkr3kw.cloudfront.net/assets/images/book/lrg/9781/8479/9781847946249.jpg',
        ], [
            'name' => 'Mindset - Updated Edition : Changing The Way You think To Fulfil Your Potential',
            'unit' => 'pcs',
            'qty' => 87,
            'price' => 149000,
            'image_url' => 'https://d1w7fb2mkkr3kw.cloudfront.net/assets/images/book/lrg/9781/4721/9781472139955.jpg',
        ]
        ]);
    }
}
