<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')
            ->select('categories.*')
            ->selectSub(function ($query) {
                $query->from('products')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn(
                        'products.category_id',
                        'categories.id'
                    );
            }, 'products_count')
            ->orderBy('categories.id')
            ->get();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $name = trim((string) $request->input('name', ''));

        $request->merge([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:categories,name',
            ],
            'slug' => [
                'required',
                'string',
                'max:100',
                'unique:categories,slug',
            ],
        ], [
            'slug.required' =>
                'Please enter a category name containing letters or numbers that can form a URL.',
            'slug.unique' =>
                'This name creates a URL slug that is already in use. Please choose another name.',
            'slug.max' =>
                'The generated URL slug is too long. Please use a shorter category name.',
        ]);

        DB::table('categories')->insert([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Category added successfully.');
    }

    public function edit(string $id)
{
    $category = DB::table('categories')->find($id);

    abort_if($category === null, 404);

    return view('admin.categories.edit', [
        'category' => $category,
    ]);
}

    public function update(Request $request, string $id)
{
    $category = DB::table('categories')->find($id);

    abort_if($category === null, 404);

    $request->merge([
        'name' => trim((string) $request->input('name', '')),
    ]);

    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:100',
            Rule::unique('categories', 'name')
                ->ignore($category->id),
        ],
    ]);

    DB::table('categories')
        ->where('id', $category->id)
        ->update([
            'name' => $validated['name'],
            'updated_at' => now(),
        ]);

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category updated successfully.');
}
    public function destroy(string $id)
{
    $category = DB::table('categories')->find($id);

    abort_if($category === null, 404);

    $hasProducts = DB::table('products')
        ->where('category_id', $category->id)
        ->exists();

    if ($hasProducts) {
        return redirect()
            ->route('admin.categories.index')
            ->with(
                'error',
                'This category contains products. Move them to another category before deleting it.'
            );
    }

    DB::table('categories')
        ->where('id', $category->id)
        ->delete();

    return redirect()
        ->route('admin.categories.index')
        ->with('success', 'Category deleted successfully.');
}
}