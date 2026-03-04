@extends('layouts.admin_base2')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Promo Code</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Edit Promo Code</li>
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
                    <form action="{{ route('promo-codes.update', $code->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="code">Promo Code</label>
                            <input type="text"
                                   name="code"
                                   id="code"
                                   class="form-control"
                                   value="{{ old('code', $code->code) }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="type">Discount Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="percentage" {{ $code->type == 'percentage' ? 'selected' : '' }}>
                                    Percentage (%)
                                </option>
                                <option value="fixed" {{ $code->type == 'fixed' ? 'selected' : '' }}>
                                    Fixed Amount
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="value">Discount Value</label>
                            <input type="number"
                                   name="value"
                                   id="value"
                                   class="form-control"
                                   value="{{ old('value', $code->value) }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="usage_limit">Usage Limit</label>
                            <input type="number"
                                   name="usage_limit"
                                   id="usage_limit"
                                   class="form-control"
                                   value="{{ old('usage_limit', $code->usage_limit) }}">
                        </div>

                        <div class="form-group">
                            <label for="expires_at">Expiry Date</label>
                            <input type="date"
                                   name="expires_at"
                                   id="expires_at"
                                   class="form-control"
                                   value="{{ old('expires_at', optional($code->expires_at)->format('Y-m-d')) }}">
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox"
                                       name="status"
                                       id="status"
                                       value="1"
                                       class="form-check-input"
                                       {{ $code->status ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">
                                    Active
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update Promo Code
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection