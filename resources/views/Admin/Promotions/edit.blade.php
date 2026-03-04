@extends('layouts.admin_base2')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ isset($promotion) ? 'Edit Promotion' : 'Add Promotion' }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ isset($promotion) ? 'Edit Promotion' : 'Add Promotion' }}</li>
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
                <h3 class="card-title">Promotion Details</h3>
            </div>

            <div class="card-body pad">
                <form action="{{ isset($promotion) ? route('promotions.update', $promotion->id) : route('promotions.store') }}" 
                      method="POST">
                    @csrf
                    @if(isset($promotion))
                        @method('PATCH')
                    @endif

                    {{-- Title --}}
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" 
                               value="{{ $promotion->title ?? old('title') }}" 
                               placeholder="Promotion Title" required>
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control textarea" rows="5">
                            {{ $promotion->description ?? old('description') }}
                        </textarea>
                    </div>

                    {{-- Start Date --}}
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control" 
                               value="{{ isset($promotion) ? $promotion->start_date->format('Y-m-d') : old('start_date') }}" 
                               required>
                    </div>

                    {{-- End Date --}}
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control" 
                               value="{{ isset($promotion) ? $promotion->end_date->format('Y-m-d') : old('end_date') }}" 
                               required>
                    </div>

                    {{-- Status --}}
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="status" value="active" 
                                   {{ isset($promotion) && $promotion->status == 'active' ? 'checked' : '' }}>
                            Active
                        </label>
                    </div>

                    {{-- Submit --}}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($promotion) ? 'Update Promotion' : 'Create Promotion' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</section>

@endsection