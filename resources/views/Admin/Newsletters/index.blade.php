@extends('layouts.admin_base2')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1>Newsletter Subscribers</h1></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Subscribers</li>
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
            <h3 class="card-title">All Subscribers</h3>

            <button type="button"
                    class="btn btn-primary float-right"
                    id="openModalBtn">
              Send Newsletter
            </button>
          </div>

          <div class="card-body">

            @if(session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Email</th>
                  <th>Subscribed At</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($subscribers as $subscriber)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $subscriber->email }}</td>
                  <td>{{ $subscriber->created_at->format('d M Y') }}</td>
                  <td>
                    <form action="{{ route('newsletters.destroy', $subscriber->id) }}"
                          method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                              class="btn btn-sm btn-danger"
                              onclick="return confirm('Remove subscriber?')">
                        <i class="fas fa-trash"></i> Delete
                      </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>
  </div>
</section>


<!-- ================= CUSTOM MODAL ================= -->

<!-- ================= CUSTOM MODAL ================= -->
<div id="newsletterModalOverlay" style="display:none;">
  <div id="newsletterModalBox">

    <div class="modal-header-custom">
      <h4>Send Newsletter</h4>
      <button type="button" id="closeModalBtn">&times;</button>
    </div>

    <form action="{{ route('newsletters.send') }}" method="POST" id="newsletterForm">
      @csrf

      <!-- Template Selector -->
      <div class="form-group mb-3">
        <label>Select Template (Optional)</label>
        <select id="templateSelect" class="form-control">
          <option value="">-- New Newsletter --</option>
          @foreach($templates as $template)
            <option value="{{ $template->id }}"
                    data-subject="{{ $template->subject }}"
                    data-message="{{ $template->message }}"
                    data-products="{{ $template->products ?? '' }}"
                    data-promo="{{ $template->promo_code ?? '' }}">
              {{ $template->name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Subject -->
      <div class="form-group mb-3">
        <label>Subject</label>
        <input type="text" name="subject" id="newsletterSubject" class="form-control" required>
      </div>

      <!-- Variables -->
      <div class="form-group mb-2">
        <label>Insert Variables:</label><br>
        <button type="button" class="btn btn-sm btn-secondary insertVar" data-value="@{{full_name}}">Full Name</button>
        <button type="button" class="btn btn-sm btn-secondary insertVar" data-value="@{{first_name}}">First Name</button>
        <button type="button" class="btn btn-sm btn-secondary insertVar" data-value="@{{last_name}}">Last Name</button>
        <button type="button" class="btn btn-sm btn-secondary insertVar" data-value="@{{product_name}}">Product Name</button>
        <button type="button" class="btn btn-sm btn-secondary insertVar" data-value="@{{product_price}}">Product Price</button>
        <button type="button" class="btn btn-sm btn-secondary insertVar" data-value="@{{promo_code}}">Promo Code</button>
      </div>

      <!-- Message -->
      <div class="form-group mb-3">
        <label>Message</label>
        <textarea name="message" id="newsletterMessage" class="form-control" rows="8" required></textarea>
      </div>

      <!-- Product Selection -->
      <div class="form-group mb-3">
        <label>Select Products (Optional)</label>
        <select name="products[]" id="newsletterProducts" class="form-control" multiple>
          @foreach($products as $product)
            <option value="{{ $product->id }}">
              {{ $product->name }} - ₦{{ number_format($product->price, 2) }}
            </option>
          @endforeach
        </select>
        <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple products.</small>
      </div>

      <!-- Optional Promo Code -->
      <div class="form-group mb-3">
            <label>Select Promo Code (optional)</label>
            <select name="promo_code" id="newsletterPromo" class="form-control">
                <option value="">-- None --</option>
                @foreach($promoCodes as $promo)
                    <option value="{{ $promo->code }}">
                        {{ $promo->code }} 
                        @if($promo->discount) - {{ $promo->discount }}% off @endif
                    </option>
                @endforeach
            </select>
        </div>

      <!-- Save as Template -->
      <div class="form-group mb-3 form-check">
        <input type="checkbox" name="save_template" class="form-check-input" id="saveTemplateCheck">
        <label class="form-check-label" for="saveTemplateCheck">Save this newsletter as template</label>
      </div>

      <!-- Submit -->
      <button type="submit" class="btn btn-primary">Send Newsletter</button>
    </form>

  </div>
</div>

<!-- ================= STYLES ================= -->

<style>
#newsletterModalOverlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.65);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999999;
}

#newsletterModalBox {
    background: #ffffff;
    width: 700px;
    max-width: 90%;
    padding: 25px;
    border-radius: 10px;
    animation: scaleIn 0.2s ease;

    /* NEW */
    max-height: 90vh;       /* limit modal height to 90% of viewport */
    overflow-y: auto;       /* enable vertical scrolling */
}

.modal-header-custom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

#closeModalBtn {
    border: none;
    background: transparent;
    font-size: 24px;
    cursor: pointer;
}

@keyframes scaleIn {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
</style>


<!-- ================= SCRIPT ================= -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    // Modal open/close
    const overlay = document.getElementById("newsletterModalOverlay");
    const openBtn = document.getElementById("openModalBtn");
    const closeBtn = document.getElementById("closeModalBtn");

    openBtn.addEventListener("click", () => overlay.style.display = "flex");
    closeBtn.addEventListener("click", () => overlay.style.display = "none");
    overlay.addEventListener("click", e => { if(e.target === overlay) overlay.style.display = "none"; });

    // Insert variables
    const textarea = document.getElementById("newsletterMessage");
    document.querySelectorAll(".insertVar").forEach(button => {
        button.addEventListener("click", function () {
            const value = this.getAttribute("data-value");
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            textarea.value = textarea.value.substring(0, start) + value + textarea.value.substring(end);
            textarea.focus();
            textarea.selectionStart = textarea.selectionEnd = start + value.length;
        });
    });

    // Template selection
    const templateSelect = document.getElementById("templateSelect");
    const subjectInput = document.getElementById("newsletterSubject");
    const productsSelect = document.getElementById("newsletterProducts");
    const promoInput = document.getElementById("newsletterPromo");
    templateSelect.addEventListener("change", function () {
        const selected = this.selectedOptions[0];
        if(selected.value === "") {
            subjectInput.value = "";
            textarea.value = "";
            promoInput.value = "";
            Array.from(productsSelect.options).forEach(opt => opt.selected = false);
        } else {
            subjectInput.value = selected.dataset.subject || "";
            textarea.value = selected.dataset.message || "";
            promoInput.value = selected.dataset.promo || "";
            const productIds = (selected.dataset.products || "").split(",").filter(Boolean);
            Array.from(productsSelect.options).forEach(opt => {
                opt.selected = productIds.includes(opt.value);
            });
        }
    });

});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const overlay = document.getElementById("newsletterModalOverlay");
    const openBtn = document.getElementById("openModalBtn");
    const closeBtn = document.getElementById("closeModalBtn");

    openBtn.addEventListener("click", function () {
        overlay.style.display = "flex";
    });

    closeBtn.addEventListener("click", function () {
        overlay.style.display = "none";
    });

    overlay.addEventListener("click", function (e) {
        if (e.target === overlay) {
            overlay.style.display = "none";
        }
    });

});
</script>

@endsection