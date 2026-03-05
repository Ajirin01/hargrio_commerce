@extends('layouts.admin_base2')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Staff</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-12">

<div class="card">
<div class="card-header">
    <h3 class="card-title">Add Staff</h3>
</div>

<div class="card-body">

@if(session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('users.store') }}" method="POST">
@csrf

<div class="row">

    <!-- First Name -->
    <div class="col-md-6">
        <div class="form-group">
            <label>First Name *</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
            @error('first_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <!-- Last Name -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Last Name *</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
            @error('last_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <!-- Email -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Email *</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <!-- Phone -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Phone *</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <!-- Password -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Password *</label>
            <input type="password" name="password" class="form-control">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <!-- Confirm Password -->
    <div class="col-md-6">
        <div class="form-group">
            <label>Confirm Password *</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
    </div>

    <!-- Role -->
    <div class="col-md-12">
        <div class="form-group">
            <label>Role *</label>
            <select name="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="order manager">Order Manager</option>
                <option value="product manager">Product Manager</option>
                <option value="customer service">Customer Service</option>
            </select>
            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

</div>

<!-- Status -->
<div class="form-group">
    <label>Status</label><br>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="is_active" value="1" checked>
        <label class="form-check-label">Active</label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="is_active" value="0">
        <label class="form-check-label">Inactive</label>
    </div>

    @error('is_active')
        <br><small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="text-center">
    <button type="submit" class="btn btn-primary px-5">
        Save Staff
    </button>
</div>

</form>

</div>
</div>

</div>
</div>
</div>
</section>

@endsection