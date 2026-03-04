@extends('layouts.admin_base2')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Add Category</li>
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

                    {{-- Error Message --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        {{-- Category Name --}}
                        <div class="form-group mb-3">
                            <label>Category Name</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                placeholder="Category Name"
                                value="{{ old('name') }}"
                                required
                            >
                        </div>

                        {{-- Description --}}
                        <div class="form-group mb-3">
                            <label>Description</label>
                            <textarea 
                                name="description" 
                                class="form-control" 
                                rows="4"
                                placeholder="Optional category description..."
                            >{{ old('description') }}</textarea>
                        </div>

                        {{-- Status --}}
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input 
                                    type="checkbox" 
                                    name="status" 
                                    class="form-check-input" 
                                    id="statusCheck"
                                    checked
                                >
                                <label class="form-check-label" for="statusCheck">
                                    Active
                                </label>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary form-control">
                                Create Category
                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection