@extends('layouts.admin_base2')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Product</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Product</li>
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
          <h3 class="card-title">Product Details</h3>
        </div>
        <div class="card-body pad">
          <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">
              {{-- Category --}}
              <div class="form-group">
                  <label>Category *</label>
                  <select name="product_category_id" class="form-control" required>
                      <option value="">Select Category</option>
                      @foreach ($categories as $cat)
                          <option value="{{ $cat->id }}"
                            {{ $product->product_category_id == $cat->id ? 'selected' : '' }}>
                              {{ $cat->name }}
                          </option>
                      @endforeach
                  </select>
              </div>

              {{-- Name --}}
              <div class="form-group">
                  <label>Product Name *</label>
                  <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
              </div>

              {{-- Base Price --}}
              <div class="form-group">
                  <label>Base Price *</label>
                  <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
              </div>

              {{-- Stock --}}
              <div class="form-group">
                  <label>Stock</label>
                  <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
              </div>

              {{-- Short Description --}}
              <div class="form-group">
                  <label>Short Description</label>
                  <textarea name="short_description" class="form-control" rows="2">{{ $product->short_description }}</textarea>
              </div>

              {{-- Long Description --}}
              <div class="form-group">
                  <label>Long Description</label>
                  <textarea name="long_description" class="form-control textarea" rows="5">{{ $product->long_description }}</textarea>
              </div>

              {{-- Preparation Instructions --}}
              <div class="form-group">
                  <label>Preparation Instructions</label>
                  <textarea name="preparation_instructions" class="form-control" rows="3">{{ $product->preparation_instructions }}</textarea>
              </div>

              {{-- Preparation Link --}}
              <div class="form-group">
                  <label>Preparation Link</label>
                  <input type="text" name="preparation_link" class="form-control" value="{{ $product->preparation_link }}">
              </div>

              {{-- Variations --}}
              <hr>
              <h5>Product Variations (Optional)</h5>
              <div id="size-variations">
                  @php
                      $sizes = is_array($product->variations) ? $product->variations : [];
                  @endphp

                  @foreach($sizes as $sizeCode => $price)
                  <div class="row mb-2 variation-row">
                      <div class="col-md-5">
                          <input type="text" name="size[]" class="form-control" placeholder="Size" value="{{ $sizeCode }}">
                      </div>
                      <div class="col-md-5">
                          <input type="number" step="0.01" name="size_price[]" class="form-control" placeholder="Extra Price" value="{{ $price }}">
                      </div>
                      <div class="col-md-2">
                          <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.variation-row').remove()">X</button>
                      </div>
                  </div>
                  @endforeach

                  {{-- Add Variation Button always at the bottom --}}
                  <div class="row mt-2">
                      <div class="col-12">
                          <button type="button" class="btn btn-sm btn-success" onclick="addSize()">+ Add New Variation</button>
                      </div>
                  </div>
              </div>
              {{-- Image --}}
              <div class="form-group mt-3">
                  <label>Product Image</label>
                  <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(this)">
                  @if($product->image)
                      <img src="{{ asset('public/uploads/'.$product->image) }}" class="preview-image mt-2">
                  @endif
              </div>

              {{-- Available --}}
              <div class="form-group mt-3">
                  <label>
                      <input type="checkbox" name="available" value="1" {{ $product->available ? 'checked' : '' }}>
                      Available
                  </label>
              </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function addSize() {
    let html = `
    <div class="row mb-2 variation-row">
        <div class="col-md-5">
            <input type="text" name="size[]" class="form-control" placeholder="Size">
        </div>
        <div class="col-md-5">
            <input type="number" step="0.01" name="size_price[]" class="form-control" placeholder="Extra Price">
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.variation-row').remove()">X</button>
        </div>
    </div>`;
    // Insert new variation row **above the Add button row**
    const container = document.getElementById('size-variations');
    const addButtonRow = container.querySelector('.row.mt-2');
    addButtonRow.insertAdjacentHTML('beforebegin', html);
}
function previewImage(input){
    const img = document.querySelector('.preview-image');
    if (input.files && input.files[0]){
        const reader = new FileReader();
        reader.onload = e => {
            if(img){
                img.src = e.target.result;
            } else {
                const newImg = document.createElement('img');
                newImg.src = e.target.result;
                newImg.className = 'preview-image mt-2';
                input.parentNode.appendChild(newImg);
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
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