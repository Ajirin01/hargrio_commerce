@extends('layouts.admin_base2')

@section('content')
<section class="content-header" style="margin-top: 50px;">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <div><h1>Order Summary</h1></div>
    <div>
      <button class="btn btn-success" onclick="printOrder()">Print Receipt / Delivery Document</button>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div id="printableArea">
      <div class="row">
        <div class="col-md-12">
          <div class="timeline">

            <!-- Order Date -->
            <div class="time-label">
              <span class="bg-red">{{ $order->created_at->format('d M, Y H:i') }}</span>
            </div>

            <!-- Order Items -->
            <div>
              <i class="fas fa-shopping-cart bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> SALE #{{ $order->id }}</span>
                <h3 class="timeline-header"><a href="#">Products Ordered</a></h3>
                <div class="timeline-body">
                  <div class="card">
                    <div class="card-body p-0">
                      <table class="table table-sm table-bordered mb-0">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Price (£)</th>
                            <th>Quantity</th>
                            <th>Subtotal (£)</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($order->items as $index => $item)
                            <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>
                                {{ $item->product->name ?? 'N/A' }}
                                @if($item->variations)
                                  @php $variations = json_decode($item->variations); @endphp
                                  <ul style="display:flex; list-style:none; padding-left:0; gap:10px; margin:0;">
                                    @if(!empty($variations->color))
                                      <li style="width:20px; height:20px; border-radius:50%; background-color: {{ $variations->color }}"></li>
                                    @endif
                                    @if(!empty($variations->size))
                                      <li>Size: {{ $variations->size }}</li>
                                    @endif
                                  </ul>
                                @endif
                              </td>
                              <td>£{{ number_format($item->price, 2) }}</td>
                              <td>{{ $item->quantity }}</td>
                              <td>£{{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Totals -->
            <div>
              <i class="fas fa-money-bill bg-green"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> Total Summary</span>
                <h3 class="timeline-header no-border">
                  @php
                    $subtotal = $order->items->sum(fn($i) => $i->price * $i->quantity);
                  @endphp
                  Subtotal: £{{ number_format($subtotal, 2) }}<br>
                  @if($order->discount)
                    Promo ({{ $order->promo_code ?? 'N/A' }}): -{{ $order->discount }}%<br>
                  @endif
                  <strong>Total Payable: £{{ number_format($order->total, 2) }}</strong>
                </h3>
              </div>
            </div>

            <!-- Payment Method -->
            <div>
              <i class="fas fa-credit-card bg-yellow"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-money-bill"></i> Payment Method</span>
                <h3 class="timeline-header">{{ strtoupper($order->payment_method ?? 'CARD') }}</h3>
              </div>
            </div>

            <!-- Shipping Address -->
            <div>
              <i class="fas fa-shipping-fast bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-truck"></i> Shipping Address</span>
                <h3 class="timeline-header">Details</h3>
                <ul style="padding-left:0; list-style:none;">
                  <li><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</li>
                  <li><strong>Phone:</strong> {{ $order->phone }}</li>
                  <li><strong>Email:</strong> {{ $order->email }}</li>
                  <li><strong>Address:</strong> {{ $order->address }}, {{ $order->state }}, {{ $order->country }}, {{ $order->zip }}</li>
                </ul>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function printOrder() {
    let printContents = document.getElementById('printableArea').innerHTML;
    let originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    window.location.reload(); // optional, restore page JS
  }
</script>

<style>
  @media print {
    .btn { display: none; }
    body { -webkit-print-color-adjust: exact; }
    .timeline { font-size: 12pt; }
  }
</style>

@endsection