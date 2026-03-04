@extends('layouts.admin_base2')
@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Promo Codes</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Home</a>
          </li>
          <li class="breadcrumb-item active">Promo Codes</li>
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
            <h3 class="card-title">All Promo Codes</h3>
            <a style="float: right" href="{{ route('promo-codes.create') }}">
              <h3 class="card-title">Add Code</h3>
            </a>
          </div>

          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Type</th>
                  <th>Value</th>
                  <th>Usage Limit</th>
                  <th>Expiry</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>

              <tbody>
                @foreach($codes as $code)
                <tr>
                  <td>{{ $code->code }}</td>

                  <td>
                    <span class="badge badge-info">
                      {{ ucfirst($code->type) }}
                    </span>
                  </td>

                  <td>
                    @if($code->type == 'percentage')
                      {{ $code->value }}%
                    @else
                      ${{ number_format($code->value, 2) }}
                    @endif
                  </td>

                  <td>
                    {{ $code->usage_limit ?? 'Unlimited' }}
                  </td>

                  <td>
                    {{ $code->expires_at ? \Carbon\Carbon::parse($code->expires_at)->format('d M Y') : 'No Expiry' }}
                </td>

                  <td>
                    <span class="badge badge-{{ $code->status ? 'success' : 'danger' }}">
                      {{ $code->status ? 'Active' : 'Inactive' }}
                    </span>
                  </td>

                  <td>
                    <a class="btn" href="{{ route('promo-codes.edit', $code->id) }}">
                      <i class="fas fa-edit text-warning"></i> Edit
                    </a>

                    <form action="{{ route('promo-codes.destroy', $code->id) }}"
                          method="POST"
                          id="promo-id{{ $code->id }}">
                      @csrf
                      @method('DELETE')
                    </form>

                    <a class="btn"
                       onclick="event.preventDefault();
                       if(confirm('Are you sure you want to delete this promo code?')){
                         document.getElementById('promo-id{{ $code->id }}').submit();
                       }">
                      <i class="fas fa-trash text-danger"></i> Delete
                    </a>
                  </td>

                </tr>
                @endforeach
              </tbody>

              <tfoot>
                <tr>
                  <th>Code</th>
                  <th>Type</th>
                  <th>Value</th>
                  <th>Usage Limit</th>
                  <th>Expiry</th>
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