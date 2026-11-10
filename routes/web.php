<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductQuestionController;
use App\Http\Controllers\Admin\ProductQuestionController as AdminProductQuestionController;

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

    $questions = DB::table('product_questions')
        ->join(
            'users',
            'product_questions.customer_id',
            '=',
            'users.id'
        )
        ->where('product_questions.product_id', $product->id)
        ->select(
            'product_questions.*',
            'users.name as customer_name'
        )
        ->orderByDesc('product_questions.id')
        ->paginate(10);

    return view('styleera_thrift', [
        'categories' => $categories,
        'products' => collect(),
        'selectedCategory' => $product->category,
        'product' => $product,
        'search' => '',
        'questions' => $questions,
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
        
        Route::get('/products',[AdminProductController::class,'index'])
            ->name('products.index');
        
        Route::get('/products/create',[AdminProductController::class,'create'])
            ->name('products.create');

        Route::post('/products',[AdminProductController::class,'store'])
            ->name('products.store');
        
        Route::get('/products/{id}/edit',[AdminProductController::class,'edit'])
            ->name('products.edit');

        Route::put('/products/{id}',[AdminProductController::class,'update'])
            ->name('products.update');

        Route::delete('/products/{id}',[AdminProductController::class,'destroy'])
            ->name('products.destroy');

        Route::get('/categories', [AdminCategoryController::class, 'index'])
            ->name('categories.index');

        Route::get('/categories/create', [AdminCategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/categories', [AdminCategoryController::class, 'store'])
          ->name('categories.store');

        Route::get('/categories/{id}/edit',[AdminCategoryController::class, 'edit']
)         ->whereNumber('id')
          ->name('categories.edit');
         
        Route::put('/categories/{id}',[AdminCategoryController::class, 'update']
)         ->whereNumber('id')
          ->name('categories.update');
        
        Route::delete('/categories/{id}',[AdminCategoryController::class, 'destroy']
)         ->whereNumber('id')
          ->name('categories.destroy');

        Route::get('/users', [AdminUserController::class, 'index'])
          ->name('users.index');

        Route::get('/questions', [AdminProductQuestionController::class, 'index'])
          ->name('questions.index');

        Route::put('/questions/{id}', [AdminProductQuestionController::class, 'update'])
          ->whereNumber('id')
          ->name('questions.update');
        
       

    });

Route::middleware('auth')->group(function () {
       Route::get('/profile', [ProfileController::class, 'edit'])
         ->name('profile.edit');

       Route::put('/profile', [ProfileController::class, 'update'])
         ->name('profile.update');

       Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
         ->name('profile.password.update');

       Route::middleware('auth')->post('/products/{product}/questions',[ProductQuestionController::class, 'store']
)        ->name('products.questions.store');
        
});