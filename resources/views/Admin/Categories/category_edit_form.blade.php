@extends('layouts.admin_base2')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Category</li>
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
                    <h3 class="card-title">Category Details</h3>
                </div>

                <div class="card-body">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        {{-- Category Name --}}
                        <div class="form-group mb-3">
                            <label>Category Name</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                value="{{ old('name', $category->name) }}"
                                required
                            >
                        </div>

                        {{-- Image Upload --}}
                        <div class="form-group mb-3">
                            <label>Category Image</label>
                            
                            @if($category->image)
                                <div class="mb-2">
                                    <img src="{{ asset('public/uploads/' . $category->image) }}" alt="Current Image" style="max-height: 100px; border-radius: 8px;">
                                </div>
                            @endif
                            
                            <input 
                                type="file" 
                                class="form-control" 
                                name="image" 
                                accept="image/*"
                            >
                            <small class="text-muted">Leave blank to keep existing image. Recommended size: 800x600px. Max: 2MB.</small>
                        </div>

                        {{-- Description --}}
                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea 
                                name="description" 
                                class="form-control" 
                                rows="4"
                            >{{ old('description', $category->description) }}</textarea>
                        </div>

                        {{-- Status --}}
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input 
                                    type="checkbox" 
                                    name="status" 
                                    class="form-check-input"
                                    id="statusCheck"
                                    {{ old('status', $category->status) == 'active' ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="statusCheck">
                                    Active
                                </label>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary form-control">
                                Update Category
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection