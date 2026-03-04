@extends('layouts.admin_base2')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Promo Code</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Add Promo Code</li>
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
                    <h3 class="card-title">Promo Code Details</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('promo-codes.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="code">Promo Code</label>
                            <input type="text" 
                                   name="code" 
                                   id="code"
                                   class="form-control" 
                                   placeholder="Enter promo code"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="type">Discount Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="percentage">Percentage (%)</option>
                                <option value="fixed">Fixed Amount</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="value">Discount Value</label>
                            <input type="number" 
                                   name="value" 
                                   id="value"
                                   class="form-control" 
                                   placeholder="Enter value"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="usage_limit">Usage Limit</label>
                            <input type="number" 
                                   name="usage_limit" 
                                   id="usage_limit"
                                   class="form-control" 
                                   placeholder="Leave empty for unlimited">
                        </div>

                        <div class="form-group">
                            <label for="expires_at">Expiry Date</label>
                            <input type="date" 
                                   name="expires_at" 
                                   id="expires_at"
                                   class="form-control">
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" 
                                       name="status" 
                                       id="status"
                                       value="1"
                                       class="form-check-input">
                                <label class="form-check-label" for="status">
                                    Active
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Create Promo Code
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection