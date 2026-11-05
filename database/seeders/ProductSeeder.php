<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products=[
            [
                'name'=>'Blue Cotton Shirt',
                'category_slug'=>'men',
                'description'=>'A comfortable blue cotton shirt for men.',
                'price'=>9.00,
                'main_image_path'=>'images/products/blue_cotton_shirt.jpg',
                'size'=>'M',
                'color'=>'Blue',
                'condition'=>'Secondhand',

            ],
           
           
            [
                'name'=>'Red Dress',
                'category_slug'=>'women',
                'description'=>'A stylish red dress for women.',
                'price'=>12.00,
                'main_image_path'=>'images/products/red_dress.jpg',
                'size'=>'S',
                'color'=>'Red',
                'condition'=>'New',

            ],
           
           
            [
                'name'=>'Green T-shirt',
                'category_slug'=>'boys',
                'description'=>'A cool green t-shirt for boys.',
                'price'=>4.00,
                'main_image_path'=>'images/products/green_tshirt.jpg',
                'size'=>'Age 8-10',
                'color'=>'Green',
                'condition'=>'New',

            ],
           
           
            [
                'name'=>'Cream Cardigan',
                'category_slug'=>'girls',
                'description'=>'A cream cardigan in good condition.',
                'price'=>6.00,
                'main_image_path'=>'images/products/cream_cardigan.jpg',
                'size'=>'Age 6-8',
                'color'=>'Cream',
                'condition'=>'Secondhand',

            ],
           
           
            [
                'name'=>'Brown Shoulder Bag',
                'category_slug'=>'accessories',
                'description'=>'A practical brown shoulder bag for everyday use.',
                'price'=>7.00,
                'main_image_path'=>'images/products/brown_bag.jpg',
                'size'=>'One Size',
                'color'=>'Brown',
                'condition'=>'Secondhand',



            ],

        ];

        DB::transaction(function () use ($products){
            foreach($products as $product){
                $categoryId=DB:: table('categories')
                ->where('slug',$product['category_slug'])
                ->value('id');

                if($categoryId === null){
                    throw new \RuntimeException('Category not found:'.$product['category_slug']
                    );
                }

                $exists=DB::table('products')
                ->where('name',$product['name'])
                ->where('category_id',$categoryId)
                ->exists();

                if($exists){
                    continue;
                }

                unset($product['category_slug']);
                DB:: table('products')
                ->insert([
                    ...$product,
                    'category_id'=>$categoryId,
                    'created_at'=>now(),
                    'updated_at'=>now()

                ]);
            }

        });


    }
    
}
