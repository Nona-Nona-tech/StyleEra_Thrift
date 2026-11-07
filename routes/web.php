<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\RegisteredUserController;

$categories = DB::table('categories')
    ->orderBy('id')
    ->get()
    ->mapWithKeys(function ($category) {
        return [$category->slug => $category->name];
    })
    ->all();

$productQuery = function () {
    return DB::table('products')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->select(
            'products.*',
            'categories.slug as category',
            'categories.name as category_name'
        );
};

Route::get('/', function (\Illuminate\Http\Request $request) use ($categories, $productQuery) {
    $search = trim((string) $request->query('q', ''));

    $query = $productQuery();

    if ($search !== '') {
        $query->where(function ($query) use ($search) {
            $query->where('products.name', 'like', '%' . $search . '%')
                ->orWhere('products.description', 'like', '%' . $search . '%')
                ->orWhere('products.color', 'like', '%' . $search . '%')
                ->orWhere('categories.name', 'like', '%' . $search . '%')
                ->orWhere('categories.slug', 'like', '%' . $search . '%');

        });
    }

    $products = $query->orderBy('products.id')->get();

    return view('styleera_thrift', [
        'categories' => $categories,
        'products' => $products,
        'selectedCategory' => null,
        'product' => null,
        'search' => $search,
    ]);
})->name('home');

Route::get('/category/{category}', function (string $category) use ($categories, $productQuery) {
    abort_unless(isset($categories[$category]), 404);

    $products = $productQuery()
        ->where('categories.slug', $category)
        ->orderBy('products.id')
        ->get();

    return view('styleera_thrift', [
        'categories' => $categories,
        'products' => $products,
        'selectedCategory' => $category,
        'product' => null,
        'search' => '',
    ]);
})->name('category');

Route::get('/products/{id}', function (string $id) use ($categories, $productQuery) {
    $product = $productQuery()
        ->where('products.id', $id)
        ->first();

    abort_if($product === null, 404);

    return view('styleera_thrift', [
        'categories' => $categories,
        'products' => collect(),
        'selectedCategory' => $product->category,
        'product' => $product,
        'search' => '',
    ]);
})->whereNumber('id')->name('product.show');

Route::middleware('guest')->group(function () {

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('register.store');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('login.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'can:access-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::view('/dashboard', 'admin.dashboard')
            ->name('dashboard');
    });