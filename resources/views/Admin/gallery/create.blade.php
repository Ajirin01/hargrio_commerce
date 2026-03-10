@extends('Admin.layouts.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4 justify-content-center">
        <div class="col-sm-12 col-xl-8">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-0">Add Gallery Image</h6>
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

                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title (Optional step summary)</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image File <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="image" name="image" required accept="image/*">
                        <div class="form-text">Recommended size: Square or portrait ratio (e.g. 800x1000px).</div>
                        <img id="imagePreview" src="#" alt="Image Preview" style="max-width: 200px; margin-top: 10px; display: none; border-radius: 5px;">
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order (0, 1, 2, ...)</label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}">
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" checked value="1">
                        <label class="form-check-label" for="is_active">Active (Show on homepage)</label>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>Save Image</button>
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
                document.getElementById('imagePreview').style.display = 'block';
            }
            fr.readAsDataURL(files[0]);
        }
    }
</script>
@endsection
