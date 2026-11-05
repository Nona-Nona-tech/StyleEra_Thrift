<?php

namespace Database\Seeders;

use Illuminate\Container\Attributes\Database;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    
    public function run(): void
    {
        $categories=[
            ['name'=>'Men','slug'=>'men'],
            ['name'=>'Women','slug'=>'women'],
            ['name'=>'Boys','slug'=>'boys'],
            ['name'=>'Girls','slug'=>'girls'],
            ['name'=>'Accessories','slug'=>'accessories'],
        
        ];

        foreach($categories as $category){
            $exists=DB::table('categories')
            ->where('slug',$category['slug'])
            ->exists();


            if(!$exists){
                DB::table('categories')
                ->insert([
                    'name'=>$category['name'],
                    'slug'=>$category['slug'],
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
            }
        }
    }
}
