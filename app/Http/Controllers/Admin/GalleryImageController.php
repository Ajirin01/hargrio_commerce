<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryImageController extends Controller
{
    public function index()
    {
        $images = GalleryImage::orderBy('sort_order')->get();
        $pageTitle = 'Visual Journey Gallery';
        return view('Admin.gallery.index', compact('images', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Add Gallery Image';
        return view('Admin.gallery.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $imagePath = $imageName;
        }

        GalleryImage::create([
            'title' => $request->title,
            'image_path' => $imagePath,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image added successfully.');
    }

    public function edit(GalleryImage $gallery)
    {
        $pageTitle = 'Edit Gallery Image';
        return view('Admin.gallery.edit', compact('gallery', 'pageTitle'));
    }

    public function update(Request $request, GalleryImage $gallery)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        $imagePath = $gallery->image_path;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($imagePath && File::exists(public_path('uploads/' . $imagePath))) {
                File::delete(public_path('uploads/' . $imagePath));
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $imagePath = $imageName;
        }

        $gallery->update([
            'title' => $request->title,
            'image_path' => $imagePath,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(GalleryImage $gallery)
    {
        if ($gallery->image_path && File::exists(public_path('uploads/' . $gallery->image_path))) {
            File::delete(public_path('uploads/' . $gallery->image_path));
        }

        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted successfully.');
    }
}
