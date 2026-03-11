<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory as Category;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('Admin.Categories.category_list', compact('categories'));
    }

    public function create()
    {
        return view('Admin.Categories.category_creation_form');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('Admin.Categories.category_edit_form', compact('category'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:191',
            'description' => 'nullable|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate slug
        $slug = Str::slug($request->name);

        // Ensure uniqueness
        $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $data['slug'] = $slug;

        // Status handling
        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        // Image handling
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $data['image'] = $imageName;
        }

        $createCategory = Category::create($data);

        return redirect()->back()->with(
            $createCategory ? 'success' : 'error',
            $createCategory ? 'Category created successfully!' : 'Could not create category'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|min:3|max:191',
            'description' => 'nullable|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Regenerate slug if name changed
        if ($category->name !== $request->name) {
            $slug = Str::slug($request->name);

            $count = Category::where('slug', 'LIKE', "{$slug}%")
                ->where('id', '!=', $id)
                ->count();

            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            $data['slug'] = $slug;
        }

        // Status handling
        $data['status'] = $request->has('status') ? 'active' : 'inactive';

        // Image handling
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && file_exists(public_path('uploads/' . $category->image))) {
                unlink(public_path('uploads/' . $category->image));
            }
            
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $data['image'] = $imageName;
        }

        $updateCategory = $category->update($data);

        return redirect()->back()->with(
            $updateCategory ? 'success' : 'error',
            $updateCategory ? 'Category successfully updated!' : 'Could not update category'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete associated image
        if ($category->image && file_exists(public_path('uploads/' . $category->image))) {
            unlink(public_path('uploads/' . $category->image));
        }

        $deleteCategory = $category->delete();

        return redirect()->back()->with(
            $deleteCategory ? 'success' : 'error',
            $deleteCategory ? 'Category successfully deleted!' : 'Could not delete category'
        );
    }
}