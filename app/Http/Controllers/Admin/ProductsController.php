<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\ProductCategory as Category;
use Validator;
use Session;


class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        // return response()->json($products);

        return view('Admin.Products.product_list',['products' => $products]);
    }
    
    public function create(Request $request)
    {
        $categories = Category::all();

        return view('Admin.Products.product_creation_form', ['categories'=> $categories]);
    }
    
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:191',
            'short_description' => 'required|min:5|max:1000',
            'long_description' => 'required|min:5|max:1000',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'product_category_id' => 'required|exists:product_categories,id',
            'size' => 'array|nullable',
            'size_price' => 'array|nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $requestData = $request->all();

        // Generate unique slug
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }
        $requestData['slug'] = $slug;

        // Status handling
        if (Auth::user()->role == 'seller') {
            $requestData['status'] = 'pending';
        } else {
            $requestData['status'] = $request->has('status') ? 'active' : 'inactive';
        }

        // Size variations only
        $sizes = $request->input('size', []);
        $sizePrices = $request->input('size_price', []);

        $sizeVariations = [];
        foreach ($sizes as $index => $size) {
            if (!empty($size)) {
                // store as float
                $sizeVariations[$size] = isset($sizePrices[$index]) ? (float)$sizePrices[$index] : 0;
            }
        }

        $requestData['variations'] = $sizeVariations;

        // Image upload
        if ($request->hasFile('image')) {
            $uploadPath = public_path('uploads/');
            $image = $request->file('image');
            $imageName = time() . '_' . rand(1000,9999) . '.' . $image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);
            $requestData['image'] = $imageName;
        } else {
            $requestData['image'] = 'no_photo.jpeg';
        }

        Product::create($requestData);

        return redirect()->back()->with('success', 'Product created successfully!');
    }

    
    public function show($id)
    {
        return response()->json("product details");
    }

    public function edit($id)
    {
        // return response()->json($request->all());
        $categories = Category::all();
        $product = Product::find($id);

        $category = Category::find($product->product_category_id);
        

        return view('Admin.Products.product_edit_form',['product'=> $product, 
        'categories'=> $categories, 'category'=> $category]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3|max:191',
            'short_description' => 'required|min:5|max:1000',
            'long_description' => 'required|min:5|max:1000',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'product_category_id' => 'required|exists:product_categories,id',
            'size' => 'array|nullable',
            'size_price' => 'array|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $product = Product::findOrFail($id);
        $requestData = $request->all();

        // Status handling
        $requestData['status'] = $request->has('status') ? 'active' : 'inactive';

        // Slug
        $requestData['slug'] = \Str::slug($requestData['name']);

        // Variations – make this **identical to store()**
        $sizes = $request->input('size', []);
        $sizePrices = $request->input('size_price', []);
        $sizeVariations = [];

        foreach ($sizes as $index => $size) {
            if (!empty($size)) {
                $sizeVariations[$size] = isset($sizePrices[$index]) ? (float)$sizePrices[$index] : 0;
            }
        }

        // Store variations exactly like store()
        $requestData['variations'] = $sizeVariations;

        // Handle photo upload
        if ($request->hasFile('image')) {
            $uploadPath = public_path('uploads/');
            $imageName = rand(123456789, 999999999) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($uploadPath, $imageName);
            $requestData['image'] = $imageName;
        }

        // Update product
        $product->update($requestData);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }
    
    public function destroy($id)
    {
        // return response()->json("product delete handler");
        $product_to_delete = Product::find($id);

        $delete_product = $product_to_delete->delete();

        if($product_to_delete){
            return redirect()->back()->with('success', 'Product deleted!');
        }else{
            return redirect()->back()->with('errors', 'Product could not delete successfully!');
        }return redirect()->back()->with('success', 'Product deleted!');
    }


    public function productBulkEditCreate(Request $request){
        $products = Product::all();
        return view('Admin.Products.bulk_edit_form', ['products'=> $products]);
    }

    public function productBulkEditStore(Request $request){
        // return response()->json($request->all());
        $loop_count = count($request->checked);

        for ($i=0; $i < $loop_count; $i++) { 
            if($request->checked[$i] === "on"){
                if($request->action === 'update'){
                    $stock = $request->quantity[$i];
                    if(Auth::user()->role == 'seller'){
                        Product::where('id', $request->id[$i])->update(['price'=> $request->price[$i], 'quantity'=> $stock]);
                    }else{
                        Product::where('id', $request->id[$i])->update(['price'=> $request->price[$i], 'quantity'=> $stock, 'status'=> $request->status[$i]]);
                    }
                }else{
                    Product::where('id', $request->id[$i])->delete();
                }
            }
        }

        return redirect()->back()->with('success', 'products successfully' . ($request->action === 'update' ? ' updated' : ' deleted'));
    }
}
