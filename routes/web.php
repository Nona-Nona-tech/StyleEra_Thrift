<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

$categories=[
    'men'=>'Men',
    'women'=>'Women',
    'boys'=>'Boys',
    'girls'=>'Girls',
    'accessories'=>'Accessories',
];

$products=[
    [
        'id'=>1,
        'name'=>'Blue Cotton Shirt',
        'category'=>'men',
        'price'=>9.00,
        'description'=>'A comfortable blue cotton shirt for men.',
        'image'=>'blue_cotton_shirt.jpg',
        'size'=>'M',
        'color'=>'Blue',
        'condition'=>'Secondhand',
    ],

    [
        'id'=>2,
        'name'=>'Red Dress',
        'category'=>'women',
        'price'=>12.00,
        'description'=>'A stylish red dress for women.',
        'image'=>'red_dress.jpg',
        'size'=>'S',
        'color'=>'Red',
        'condition'=>'New',

    ],

    [
        
        'id'=>3,
        'name'=>'Green T-shirt',
        'category'=>'boys',
        'price'=>4.00,
        'description'=>'A cool green t-shirt for boys.',
        'image'=>'green_tshirt.jpg',
        'size'=>'Age 8-10',
        'color'=>'Green',
        'condition'=>'New',

    ],

    [
        'id'=>4,
        'name'=>'Cream Cardigan',
        'category'=>'girls',
        'price'=>6.00,
        'description'=>'A cream cardigan in good condition.',
        'image'=>'cream_cardigan.jpg',
        'size'=>'Age 6-8',
        'color'=>'Cream',
        'condition'=>'Secondhand',

    ],

    [
        'id'=>5,
        'name'=>'Brown Shoulder bag',
        'category'=>'accessories',
        'price'=>7.00,
        'description'=>'A practical shoulder bag for daily use.',
        'image'=>'brown-bag.jpg',
        'size'=>'One Size',
        'color'=>'Brown',
        'condition'=>'Secondhand',

    ],

];

Route::get('/', function () use($categories, $products) {
    return view('styleera_thrift',[
        'categories'=>$categories,
        'products'=>$products,
        'selectedCategory'=>null,
        'product'=>null,

    ]);
})->name('home');

Route::get('/category/{category}', function ( string $category) use($categories, $products) {
     
    abort_unless(isset($categories[$category]), 404);

    $filteredProducts = array_filter(
        $products,
        fn (array $item) => $item['category'] === $category
    );

    return view('styleera_thrift', [
        'categories' => $categories,
        'products' => $filteredProducts,
        'selectedCategory' => $category,
        'product' => null,
    ]);
})->name('category');

Route::get('/products/{id}', function (string $id) use ($categories, $products) {
    $product = collect($products)->firstWhere('id', (int) $id);

    abort_if($product === null, 404);

    return view('styleera_thrift', [
        'categories' => $categories,
        'products' => [],
        'selectedCategory' => $product['category'],
        'product' => $product,
    ]);
})->whereNumber('id')->name('product.show');

