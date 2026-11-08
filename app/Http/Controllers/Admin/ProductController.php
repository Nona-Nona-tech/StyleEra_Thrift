<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
   public function index()
   {
    $products = DB:: table('products')
    ->join(
        
        'categories',
        'products.category_id', '=', 'categories.id',

    )
    ->select(
        'products.*',
        'categories.name as category_name'
    )
    ->orderByDesc('products.id')
    ->paginate(10);

    return view('admin.products.index',[
        'products'=>$products,
    ]);
   }

   public function create()
   {
    $categories = DB::table('categories')
        ->orderBy('id')
        ->get();

    return view('admin.products.create', [
        'categories' => $categories,
    ]);
   }

   public function store(Request $request)
   {
    $validated=$request->validate([
        'name'=>['required','string','max:255'],
        'category_id'=>[
            'required',
            'integer',
            'exists:categories,id',
        ],
        'description'=>['required','string','max:10000'],
        'price'=>[
            'required',
            'numeric',
            'min:0.01',
            'max:99999999.99',
            'decimal:0,2',

        ],
        'size'=>['nullable','string','max:50'],
        'color'=>['nullable','string','max:50'],
        'condition'=>['required','in:New,Secondhand'],
        'photo'=>[
            'required',
            'image',
            'mimes:jpeg,png,jpg,webp',
            'max:2048',
        ],

    ]);


    $path=$request->file('photo')->store('products','public');
    if($path===false){
        return back()
        ->withInput()
        ->withErrors([
            'photo'=>'Photo could not be saved. Please try again.',
        ]);
    }

    try{
        DB::table('products')->insert([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'main_image_path' => 'storage/' . $path,
                'size' => $validated['size'] ?? null,
                'color' => $validated['color'] ?? null,
                'condition' => $validated['condition'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    } catch (\Throwable $exception){
        Storage::disk('public')->delete($path);
        throw $exception;
    }
    return redirect()
        ->route('admin.products.index')
        ->with('success','Product added successfully.');
   }

   public function edit(string $id)
{
    $product = DB::table('products')->find($id);

    if ($product === null) {
        abort(404);
    }

    $categories = DB::table('categories')
        ->orderBy('id')
        ->get();

    return view('admin.products.edit', [
        'product' => $product,
        'categories' => $categories,
    ]);
}

public function update(Request $request, string $id)
{
    $product = DB::table('products')->find($id);

    if ($product === null) {
        abort(404);
    }

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'category_id' => [
            'required',
            'integer',
            'exists:categories,id',
        ],
        'description' => ['required', 'string', 'max:10000'],
        'price' => [
            'required',
            'numeric',
            'min:0.01',
            'max:99999999.99',
            'decimal:0,2',
        ],
        'size' => ['nullable', 'string', 'max:50'],
        'color' => ['nullable', 'string', 'max:50'],
        'condition' => ['required', 'in:New,Secondhand'],
        'photo' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],
    ]);

    $updateData = [
        'category_id' => $validated['category_id'],
        'name' => $validated['name'],
        'description' => $validated['description'],
        'price' => $validated['price'],
        'size' => $validated['size'] ?? null,
        'color' => $validated['color'] ?? null,
        'condition' => $validated['condition'],
        'updated_at' => now(),
    ];

    $oldPhotoPath = null;

    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('products', 'public');

        if ($path === false) {
            return back()
                ->withInput()
                ->withErrors([
                    'photo' => 'The photo could not be saved. Please try again.',
                ]);
        }

        $updateData['main_image_path'] = 'storage/' . $path;

        if ($product->main_image_path) {
            $oldPhotoPath = Str::after($product->main_image_path, 'storage/');
        }
    }

    try {
        DB::table('products')
            ->where('id', $id)
            ->update($updateData);
    } catch (\Throwable $exception) {
        if (isset($path)) {
            Storage::disk('public')->delete($path);
        }

        throw $exception;
    }

    if ($oldPhotoPath) {
        Storage::disk('public')->delete($oldPhotoPath);
    }

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Product updated successfully.');
}


    public function destroy(string $id)
{
    $product = DB::table('products')->find($id);

    if ($product === null) {
        abort(404);
    }

    $photoPath = null;

    if ($product->main_image_path) {
        $photoPath = Str::after($product->main_image_path, 'storage/');
    }

    try {
        DB::table('products')
            ->where('id', $id)
            ->delete();
    } catch (\Throwable $exception) {
        throw $exception;
    }

    if ($photoPath) {
        Storage::disk('public')->delete($photoPath);
    }

    return redirect()
        ->route('admin.products.index')
        ->with('success', 'Product deleted successfully.');
}

}
