<!-- Product Modal -->
<div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row g-4">
          <!-- Image -->
          <div class="col-md-6 text-center">
            <img src="{{ asset('site/images/'.$product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
          </div>
          <!-- Info -->
          <div class="col-md-6">
            <h2 class="fw-bold">{{ $product->name }}</h2>
            <p class="price display-6 fw-bold" id="productPrice{{ $product->id }}" style="color: #8b670b;">£{{ number_format($product->price, 2) }}</p>

            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3" id="productTab{{ $product->id }}" role="tablist">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description{{ $product->id }}">Description</button>
              </li>
              @if($product->preparation_instructions)
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#preparation{{ $product->id }}">Preparation</button>
              </li>
              @endif
            </ul>
            <div class="tab-content mb-4">
              <div class="tab-pane fade show active" id="description{{ $product->id }}">
                @if($product->short_description)<p class="text-muted">{{ $product->short_description }}</p>@endif
                @if($product->long_description)<p class="text-secondary">{{ $product->long_description }}</p>@endif
              </div>
              @if($product->preparation_instructions)
              <div class="tab-pane fade" id="preparation{{ $product->id }}">
                <p>{{ $product->preparation_instructions }}</p>
              </div>
              @endif
            </div>

            <!-- Variation + Quantity + Add to Cart -->
            <div class="d-flex align-items-start gap-3 mb-3">
              @if($product->variations && count($product->variations) > 0)
              <select id="variation{{ $product->id }}" class="form-select" style="width:120px;">
                @foreach($product->variations as $weight => $price)
                  <option value="{{ $weight }}" data-price="{{ $price }}">{{ $weight }} kg (+£{{ number_format($price,2) }})</option>
                @endforeach
              </select>
              @endif

              <input type="number" id="quantity{{ $product->id }}" class="form-control" value="1" min="1" style="width:100px; height:38px;">

              <button type="button" class="btn btn-success add-to-cart-detail" data-id="{{ $product->id }}" style="height:38px; padding:0 20px;">Add to Cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    const priceEl = $('#productPrice{{ $product->id }}');
    const variationSelect = $('#variation{{ $product->id }}');
    const defaultPrice = {{ $product->price }};

    if (variationSelect.length) {
        function updatePrice() {
            const selected = variationSelect.find(':selected');
            const variationPrice = selected.data('price');
            priceEl.text('£' + (variationPrice !== undefined ? parseFloat(variationPrice).toFixed(2) : parseFloat(defaultPrice).toFixed(2)));
        }
        variationSelect.on('change', updatePrice);
        updatePrice();
    }

    $('.add-to-cart-detail').click(function() {
        const productId = $(this).data('id');
        const quantity = $('#quantity'+productId).val();
        const variation = $('#variation'+productId).length ? $('#variation'+productId).val() : null;

        $.ajax({
            url: "{{ url('cart/add') }}/" + productId,
            type: "POST",
            data: {_token:"{{ csrf_token() }}", quantity: quantity, variation: variation},
            success: function(response) {
                alert(response.message);
                if(response.cart_count !== undefined){
                    if($('#cart-count').length){
                        $('#cart-count').text(response.cart_count);
                    } else {
                        $('.nav-link[href="{{ route('cart.index') }}"]').append(
                            '<span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'+response.cart_count+'</span>'
                        );
                    }
                }
            },
            error: function(xhr){
                if(xhr.status===401||xhr.status===419) window.location.href="{{ route('login') }}";
                else alert('Error adding product to cart.');
            }
        });
    });
});
</script>