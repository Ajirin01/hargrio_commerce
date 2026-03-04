<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('Admin.Posts.index', compact('posts'));
    }

    public function create()
    {
        return view('Admin.Posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => 'required|min:3|max:191',
            'excerpt'       => 'nullable|max:500',
            'content'       => 'required',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle feature image upload
        if ($request->hasFile('feature_image')) {
            $file = $request->file('feature_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['feature_image'] = 'uploads/' . $filename;
        }

        // Generate slug
        $slug = Str::slug($request->title);
        $count = Post::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $data['slug'] = $slug;
        $data['status'] = $request->has('status') ? 'published' : 'draft';

        Post::create($data);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('Admin.Posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $data = $request->validate([
            'title'         => 'required|min:3|max:191',
            'excerpt'       => 'nullable|max:500',
            'content'       => 'required',
            'feature_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Handle feature image upload
        if ($request->hasFile('feature_image')) {
            // Delete old image if exists
            if ($post->feature_image && file_exists(public_path($post->feature_image))) {
                unlink(public_path($post->feature_image));
            }

            $file = $request->file('feature_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['feature_image'] = 'uploads/' . $filename;
        }

        // Update slug if title changed
        if ($post->title !== $request->title) {
            $slug = Str::slug($request->title);
            $count = Post::where('slug', 'LIKE', "{$slug}%")
                ->where('id', '!=', $id)
                ->count();

            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            $data['slug'] = $slug;
        }

        $data['status'] = $request->has('status') ? 'published' : 'draft';

        $post->update($data);

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Delete feature image if exists
        if ($post->feature_image && file_exists(public_path($post->feature_image))) {
            unlink(public_path($post->feature_image));
        }

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }
}