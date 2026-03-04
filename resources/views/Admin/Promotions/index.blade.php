@extends('layouts.admin_base2')
@section('content')

<section class="content-header">
    <div class="container-fluid mb-3">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Posts</h1>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Posts</h3>
            </div>

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                <span class="badge {{ $post->status == 'published' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d M Y') }}</td>
                            <td>
                                <a class="btn" href="{{ route('posts.edit', $post->id) }}">
                                    <i class="fas fa-edit text-warning"></i> Edit
                                </a>

                                <form action="{{ route('posts.destroy', $post->id) }}" 
                                      method="POST" 
                                      id="post-id{{ $post->id }}" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <a class="btn"
                                   onclick="event.preventDefault();
                                   if(confirm('Are you sure you want to delete this post?')){
                                       document.getElementById('post-id{{ $post->id }}').submit();
                                   }">
                                    <i class="fas fa-trash text-danger"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</section>

@endsection