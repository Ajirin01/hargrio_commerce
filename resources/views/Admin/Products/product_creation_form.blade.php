@extends('layouts.admin_base2')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Product</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-info">
          <div class="card-header">
            <h3 class="card-title">
              Product Details
            </h3>
            <!-- tools box -->
            <div class="card-tools">
              <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                      title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.card-header -->
          
            <div class="card-body pad">
              <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        {{-- Category --}}
                        <div class="form-group">
                            <label>Category *</label>
                            <select name="product_category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('product_category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Name --}}
                        <div class="form-group">
                            <label>Product Name *</label>
                            <input type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                required>
                        </div>

                        {{-- Price --}}
                        <div class="form-group">
                            <label>Base Price *</label>
                            <input type="number"
                                step="0.01"
                                name="price"
                                class="form-control"
                                value="{{ old('price') }}"
                                required>
                        </div>

                        {{-- Stock --}}
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number"
                                name="stock"
                                class="form-control"
                                value="{{ old('stock') }}">
                        </div>

                        {{-- Short Description --}}
                        <div class="form-group">
                            <label>Short Description</label>
                            <textarea name="short_description"
                                    class="form-control"
                                    rows="2">{{ old('short_description') }}</textarea>
                        </div>

                        {{-- Long Description --}}
                        <div class="form-group">
                            <label>Long Description</label>
                            <textarea name="long_description"
                                    class="form-control textarea"
                                    rows="5">{{ old('long_description') }}</textarea>
                        </div>

                        {{-- Preparation Instructions --}}
                        <div class="form-group">
                            <label>Preparation Instructions</label>
                            <textarea name="preparation_instructions"
                                    class="form-control"
                                    rows="3">{{ old('preparation_instructions') }}</textarea>
                        </div>

                        {{-- Preparation Link --}}
                        <div class="form-group">
                            <label>Preparation Link</label>
                            <input type="text"
                                name="preparation_link"
                                class="form-control"
                                value="{{ old('preparation_link') }}">
                        </div>

                        {{-- Variations Section --}}
                        <hr>
                        <h5>Product Variations (Optional)</h5>
                        {{-- Sizes --}}
                        <div id="size-variations">
                            <label>Sizes</label>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <input type="text" name="size[]" class="form-control" placeholder="Size">
                                </div>
                                <div class="col-md-5">
                                    <input type="number" step="0.01" name="size_price[]" class="form-control" placeholder="Extra Price">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-sm btn-success" onclick="addSize()">+</button>
                                </div>
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="form-group mt-3">
                            <label>Product Image</label>
                            <input type="file"
                                name="image"
                                class="form-control"
                                accept="image/*">
                        </div>

                        {{-- Available --}}
                        <div class="form-group mt-3">
                            <label>
                                <input type="checkbox"
                                    name="available"
                                    value="1"
                                    {{ old('available', true) ? 'checked' : '' }}>
                                Available
                            </label>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </form>
            
              </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>

 <script>

function addSize() {
    let html = `
    <div class="row mb-2">
        <div class="col-md-5">
            <input type="text" name="size[]" class="form-control" placeholder="Size">
        </div>
        <div class="col-md-5">
            <input type="number" step="0.01" name="size_price[]" class="form-control" placeholder="Extra Price">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.row').remove()">X</button>
        </div>
    </div>`;
    document.getElementById('size-variations').insertAdjacentHTML('beforeend', html);
}
</script>

<style>
  .preview-image {
    width: 100px;
    height: 100px;
    margin-right: 10px;
}
</style>
@endsection