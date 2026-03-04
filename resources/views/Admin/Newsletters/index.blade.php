@extends('layouts.admin_base2')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"><h1>Newsletter Subscribers</h1></div>
        </div>
    </div>
</section>

<section class="content">
<div class="card">
  <div class="card-header">
    <h3 class="card-title">All Subscribers</h3>
  </div>

  <div class="card-body">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Email</th>
          <th>Subscribed At</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($subscribers as $subscriber)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $subscriber->email }}</td>
          <td>{{ $subscriber->created_at->format('d M Y') }}</td>
          <td>
            <form action="{{ route('newsletters.destroy', $subscriber->id) }}" method="POST" class="d-inline">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Remove subscriber?')">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $subscribers->links() }}

    <hr>

    <h4>Send Newsletter</h4>
    <form action="{{ route('newsletters.send') }}" method="POST">
      @csrf
      <div class="form-group">
        <label>Subject</label>
        <input type="text" name="subject" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Message</label>
        <textarea name="message" class="form-control" rows="5" required></textarea>
      </div>
      <button class="btn btn-primary">Send Newsletter</button>
    </form>

  </div>
</div>
</section>

@endsection