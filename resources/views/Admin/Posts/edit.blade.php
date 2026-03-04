@extends('layouts.admin_base2')
@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ isset($post) ? 'Edit Post' : 'Add Post' }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ isset($post) ? 'Edit Post' : 'Add Post' }}</li>
          </ol>
        </div>
      </div>
    </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-outline card-info">
        <div class="card-header">
          <h3 class="card-title">Post Details</h3>
        </div>

        <div class="card-body pad">

          {{-- Display Validation Errors --}}
          @if($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" 
                method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($post))
              @method('PATCH')
            @endif

            <div class="form-group">
              <label>Title</label>
              <input type="text" name="title" class="form-control"
                     value="{{ $post->title ?? '' }}" placeholder="Post Title" required>
            </div>

            <div class="form-group">
              <label>Excerpt</label>
              <textarea name="excerpt" class="form-control" rows="3">{{ $post->excerpt ?? '' }}</textarea>
            </div>

            <div class="form-group">
              <label>Feature Image</label>
              <input type="file" name="feature_image" class="form-control" accept="image/*">
              
              @if(isset($post) && $post->feature_image)
                <div class="mt-2">
                  <p>Current Image:</p>
                  <img src="{{ asset('uploads/' . $post->feature_image) }}" alt="Feature Image" style="max-width:200px;">
                </div>
              @endif
            </div>

            <div class="form-group">
              <label>Content</label>
              <textarea name="content" class="form-control textarea" rows="6" required>{{ $post->content ?? '' }}</textarea>
            </div>

            <div class="form-group">
              <label>
                <input type="checkbox" name="status" value="published"
                       {{ isset($post) && $post->status == 'published' ? 'checked' : '' }}> Publish
              </label>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">{{ isset($post) ? 'Update Post' : 'Create Post' }}</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection