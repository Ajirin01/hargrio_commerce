@extends('Admin.layouts.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4 justify-content-center">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-0">Edit Gallery Image</h6>
                    <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left me-2"></i>Back to Gallery</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title (Optional step summary)</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $gallery->title) }}">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Replace Image (Leave empty to keep current)</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        <div class="form-text">Current image is shown below if you don't choose a new one.</div>
                        <img id="imagePreview" src="{{ asset('public/uploads/' . $gallery->image_path) }}" alt="Current Image" style="max-width: 200px; margin-top: 10px; display: block; border-radius: 5px;">
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order (0, 1, 2, ...)</label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}">
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ $gallery->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active (Show on homepage)</label>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>Update Image</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('image').onchange = function (evt) {
        var tgt = evt.target || window.event.srcElement,
            files = tgt.files;

        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                document.getElementById('imagePreview').src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        }
    }
</script>
@endsection
