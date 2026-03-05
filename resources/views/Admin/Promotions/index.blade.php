@extends('layouts.admin_base2')
@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Promotions</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Home</a>
          </li>
          <li class="breadcrumb-item active">Promotions</li>
        </ol>
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
            <h3 class="card-title">All Promotions</h3>
            <a style="float:right" href="{{ route('promotions.create') }}">
              <h3 class="card-title">Add Promotion</h3>
            </a>
          </div>

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>

              <tbody>
                @foreach($promotions as $promotion)
                <tr>
                  <td>{{ $promotion->title }}</td>

                  <td>
                    {{ \Carbon\Carbon::parse($promotion->start_date)->format('d M Y') }}
                  </td>

                  <td>
                    {{ \Carbon\Carbon::parse($promotion->end_date)->format('d M Y') }}
                  </td>

                  <td>
                    @php
                      $now = \Carbon\Carbon::now();
                      $isExpired = $now->gt(\Carbon\Carbon::parse($promotion->end_date));
                    @endphp

                    @if($isExpired)
                      <span class="badge badge-danger">Expired</span>
                    @else
                      <span class="badge badge-{{ $promotion->status == 'active' ? 'success' : 'secondary' }}">
                        {{ ucfirst($promotion->status) }}
                      </span>
                    @endif
                  </td>

                  <td>
                    <a class="btn" href="{{ route('promotions.edit', $promotion->id) }}">
                      <i class="fas fa-edit text-warning"></i> Edit
                    </a>

                    <form action="{{ route('promotions.destroy', $promotion->id) }}"
                          method="POST"
                          id="promotion-id{{ $promotion->id }}">
                      @csrf
                      @method('DELETE')
                    </form>

                    <a class="btn"
                       onclick="event.preventDefault();
                       if(confirm('Are you sure you want to delete this promotion?')){
                         document.getElementById('promotion-id{{ $promotion->id }}').submit();
                       }">
                      <i class="fas fa-trash text-danger"></i> Delete
                    </a>
                  </td>

                </tr>
                @endforeach
              </tbody>

              <tfoot>
                <tr>
                  <th>Title</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </tfoot>

            </table>
          </div>

        </div>

      </div>
    </div>
  </div>
</section>

@endsection