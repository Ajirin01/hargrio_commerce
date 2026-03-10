<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Hargrio">
  <link rel="shortcut icon" href="{{ asset('site/favicon.png') }}">

  <title>Hargrio | Premium Heritage Grain Flour Blends</title>
  <meta name="description" content="Hargrio Limited is a UK-based food manufacturing company specialising in heritage and alternative grain flour blends. Wheat-free, nutritious and suitable for traditional and modern cooking.">
  <meta name="keywords" content="Hargrio Limited, heritage grains UK, wheat-free flour, alternative grains, teff flour, millet flour, African swallow UK, healthy staple foods">

  <!-- CSS -->
  <link href="{{ asset('site/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Montserrat:ital,wght@0,300;0,700;0,900;1,300&display=swap" rel="stylesheet">
  <link href="{{ asset('site/css/tiny-slider.css') }}" rel="stylesheet">
  <link href="{{ asset('site/css/style.css') }}" rel="stylesheet">

  <style>
    /* ============================================================
       CSS DESIGN TOKENS
       ============================================================ */
    :root {
      --brand-primary:        #5C4742;
      --brand-secondary:      #9EBA9B;
      --brand-gold:           #9EBA9B;
      --brand-light:          #FBF7F2;
      --font-family-sans-alt: 'Inter', sans-serif;
      --bg-cream:             #FBF7F2;
      --bg-sage:              #F0F5F0;
      --bg-choc:              #F9F7F7;
    }
    .font-serif { font-family: 'Playfair Display', Georgia, serif !important; }

    /* ============================================================
       NAVBAR — DEFAULT STATE (transparent, sits over hero image)
       ============================================================ */
    .custom-navbar {
      padding: 0.85rem 0 !important;
      transition: background 0.35s ease, box-shadow 0.35s ease, padding 0.35s ease;
    }

    /* Brand: white by default */
    .custom-navbar .navbar-brand span {
      color: #fff !important;
    }

    /* nav links: white */
    .custom-navbar .custom-navbar-nav .nav-link,
    .custom-navbar .custom-navbar-nav li a {
      color: rgba(255,255,255,0.88) !important;
      opacity: 1 !important;
    }
    .custom-navbar .custom-navbar-nav .nav-link:hover,
    .custom-navbar .custom-navbar-nav li a:hover,
    .custom-navbar .custom-navbar-nav li.active > a {
      color: #fff !important;
    }
    /* user icon SVG */
    .custom-navbar .nav-link svg {
      stroke: rgba(255,255,255,0.88);
    }

    /* Hamburger: white bars on transparent nav */
    .custom-navbar .navbar-toggler {
      border-color: rgba(255,255,255,0.35);
      padding: 6px 10px;
    }
    .custom-navbar .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255%2C255%2C255%2C0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* ============================================================
       MOBILE NAV COLLAPSE — open state: dark glassmorphism panel
       so white link text stays readable over the hero image
       ============================================================ */
    @media (max-width: 767.98px) {
      .custom-navbar .navbar-collapse {
        background: rgba(25, 14, 10, 0.96);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-top: 1px solid rgba(255,255,255,0.1);
        margin-top: 0.5rem;
        border-radius: 14px;
        padding: 0.5rem 1.25rem 1.25rem;
        box-shadow: 0 20px 50px rgba(0,0,0,0.45);
      }
      /* force white text in collapsed panel */
      .custom-navbar .navbar-collapse .nav-link,
      .custom-navbar .navbar-collapse li a {
        color: rgba(255,255,255,0.9) !important;
        padding-top: 0.65rem !important;
        padding-bottom: 0.65rem !important;
        border-bottom: 1px solid rgba(255,255,255,0.08) !important;
        font-size: 1rem;
      }
      .custom-navbar .navbar-collapse li:last-child a,
      .custom-navbar .navbar-collapse li:last-child .btn {
        border-bottom: none !important;
      }
      /* Shop Now pill in mobile panel */
      .custom-navbar .navbar-collapse .btn-nav-shop {
        width: 100%;
        text-align: center;
        margin-top: 0.6rem;
        border-bottom: none !important;
        display: block;
      }
      /* user icon SVG: white in panel */
      .custom-navbar .navbar-collapse .nav-link svg {
        stroke: rgba(255,255,255,0.88);
      }
      /* align items top not center on mobile */
      .custom-navbar .custom-navbar-nav {
        align-items: flex-start !important;
      }
      /* user dropdown row */
      .custom-navbar .nav-item.dropdown {
        margin-top: 0 !important;
      }
    }

    /* ============================================================
       STICKY NAVBAR — scrolled (solid white, brand-chocolate text)
       ============================================================ */
    .custom-navbar.navbar-sticky {
      background: #ffffff !important;
      box-shadow: 0 2px 24px rgba(0,0,0,0.08);
      padding: 0.45rem 0 !important;
    }
    .custom-navbar.navbar-sticky .navbar-brand span {
      color: var(--brand-primary) !important;
    }
    .custom-navbar.navbar-sticky .custom-navbar-nav .nav-link,
    .custom-navbar.navbar-sticky .custom-navbar-nav li a {
      color: var(--brand-primary) !important;
    }
    .custom-navbar.navbar-sticky .custom-navbar-nav .nav-link:hover,
    .custom-navbar.navbar-sticky .custom-navbar-nav li.active > a {
      color: var(--brand-secondary) !important;
    }
    .custom-navbar.navbar-sticky .nav-link svg {
      stroke: var(--brand-primary);
    }
    /* Hamburger: dark bars when sticky */
    .custom-navbar.navbar-sticky .navbar-toggler {
      border-color: rgba(92,71,66,0.2);
    }
    .custom-navbar.navbar-sticky .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2892%2C71%2C66%2C0.85%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    /* Mobile collapse on sticky: white panel */
    @media (max-width: 767.98px) {
      .custom-navbar.navbar-sticky .navbar-collapse {
        background: #ffffff;
        backdrop-filter: none;
        -webkit-backdrop-filter: none;
        border-top: 1px solid rgba(0,0,0,0.06);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
      }
      .custom-navbar.navbar-sticky .navbar-collapse .nav-link,
      .custom-navbar.navbar-sticky .navbar-collapse li a {
        color: var(--brand-primary) !important;
        border-bottom-color: rgba(0,0,0,0.07) !important;
      }
      .custom-navbar.navbar-sticky .navbar-collapse .nav-link svg {
        stroke: var(--brand-primary);
      }
    }

    /* ============================================================
       SHOP NOW PILL
       ============================================================ */
    .btn-nav-shop {
      background: rgba(255,255,255,0.15) !important;
      color: #fff !important;
      border: 1.5px solid rgba(255,255,255,0.55) !important;
      font-size: 0.9rem;
      transition: all 0.25s ease;
    }
    .btn-nav-shop:hover {
      background: #fff !important;
      color: var(--brand-primary) !important;
      border-color: #fff !important;
    }
    /* sticky state */
    .custom-navbar.navbar-sticky .btn-nav-shop {
      background: var(--brand-primary) !important;
      color: #fff !important;
      border-color: var(--brand-primary) !important;
    }
    .custom-navbar.navbar-sticky .btn-nav-shop:hover {
      background: var(--brand-secondary) !important;
      border-color: var(--brand-secondary) !important;
      color: var(--brand-primary) !important;
    }

    /* ============================================================
       SCROLL REVEAL
       ============================================================ */
    .scroll-reveal {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.65s ease, transform 0.65s ease;
      transition-delay: var(--reveal-delay, 0ms);
    }
    .scroll-reveal.revealed {
      opacity: 1;
      transform: translateY(0);
    }

    /* ============================================================
       HERO ENTRANCE ANIMATIONS
       ============================================================ */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(30px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-up { animation: fadeUp 0.7s ease forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.15s; }
    .delay-2 { animation-delay: 0.30s; }
    .delay-3 { animation-delay: 0.45s; }

    /* ============================================================
       GENERAL UI POLISH
       ============================================================ */
    body { overflow-x: hidden; }

    /* Hero: ensure content doesn't hide behind fixed nav */
    .hero-v2 { padding-top: 80px; }
    @media (max-width: 767.98px) {
      .hero-v2 { padding-top: 70px; }
    }

    /* Footer newsletter: stack on small screens */
    @media (max-width: 575.98px) {
      .footer-section form.d-flex {
        flex-direction: column !important;
        gap: 0.75rem;
      }
      .footer-section form.d-flex input,
      .footer-section form.d-flex button {
        max-width: 100% !important;
        width: 100% !important;
      }
    }

    /* Dropdowns: always on top */
    .dropdown-menu { z-index: 1055; }

    /* Prevent white flash on navbar-toggler outline */
    .navbar-toggler:focus { box-shadow: none !important; }
  </style>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/69a8d2f13d22e31c2f0a1bb2/1jitng0bp';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script>
  <!--End of Tawk.to Script-->
</head>

<body>

  <!-- ── Navigation ── -->
  <nav class="custom-navbar navbar navbar-expand-md navbar-dark fixed-top w-100" style="z-index: 1030;" aria-label="Hargrio navigation">

    <div class="container py-1">

      <!-- Brand -->
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <img src="{{ asset('site/images/hargrio_favicon.png') }}" width="42" height="42" alt="Hargrio Logo" class="me-2" style="">
        <span class="fs-5 fw-bold" style="letter-spacing: 1px;"><img id="navTextLogo" src="{{ asset('site/images/hargrio_logo_white.png') }}" width="150" height="25" style="transition: all 0.3s ease;"><span style="color: var(--brand-gold);">.</span></span>
      </a>

      <!-- Hamburger toggle -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
              aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarsFurni">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0 fw-medium align-items-md-center" style="font-size: 0.95rem;">
          <li class="nav-item {{ Request::is('/') || Request::path() == '' ? 'active' : '' }}">
            <a class="nav-link text-nowrap" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
            <a class="nav-link text-nowrap" href="{{ url('/about') }}">About Us</a>
          </li>
          <li class="nav-item {{ Request::is('shop') ? 'active' : '' }}">
            <a class="nav-link text-nowrap" href="{{ url('/shop') }}">Products</a>
          </li>
          <li class="nav-item {{ Request::is('blog') ? 'active' : '' }}">
            <a class="nav-link text-nowrap" href="{{ url('/blog') }}">Blog</a>
          </li>
          <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
            <a class="nav-link text-nowrap" href="{{ url('/contact') }}">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-nowrap" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#wholesaleModal">Wholesale</a>
          </li>

          <!-- User account dropdown -->
          <li class="nav-item dropdown ms-md-3">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" id="userDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
              <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
              </svg>
            </a>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-3 mt-2" style="min-width:180px;">
              @auth
                <li><a class="dropdown-item py-2 fw-medium" href="{{ route('orders.index') }}" style="color: var(--brand-primary) !important;">My Orders</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item py-2 fw-medium text-danger">Logout</button>
                  </form>
                </li>
              @else
                <li><a class="dropdown-item py-2 fw-medium" href="{{ route('login') }}">Login</a></li>
                <li><a class="dropdown-item py-2 fw-medium" href="{{ route('register') }}">Register</a></li>
              @endauth
            </ul>
          </li>

          <!-- Shop CTA pill -->
          <li class="nav-item ms-md-2 mt-3 mt-md-0">
            <a class="btn btn-nav-shop px-4 py-2 rounded-pill fw-bold" href="{{ url('/shop') }}" style="color: var(--brand-light) !important;">Shop Now</a>
          </li>
        </ul>
      </div>

    </div>
  </nav>
  <!-- ── End Navigation ── -->

  @yield('content')

  <!-- ── Footer ── -->
  <footer class="footer-section pt-5 pb-4" style="background-color: var(--brand-primary); color: rgba(255,255,255,0.75);">
    <div class="container">

      <!-- Newsletter row -->
      <div class="row mb-5 pb-4 border-bottom" style="border-color: rgba(255,255,255,0.1) !important;">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <h3 class="font-serif text-white mb-2">Join Our Newsletter</h3>
          <p class="mb-0 small">Get baking tips, new product announcements, and exclusive offers.</p>
        </div>
        <div class="col-lg-6">
          <form action="{{ route('newsletters.store') }}" method="POST" class="w-100">
            @csrf
            <div class="row g-2">
              <div class="col-12 col-md-6 mb-2">
                <input type="text" name="name" class="form-control rounded-pill border-0 px-4 py-3 w-100 shadow-sm"
                      placeholder="Your Name" required>
              </div>
              <div class="col-12 col-md-6 mb-2">
                <input type="email" name="email" class="form-control rounded-pill border-0 px-4 py-3 w-100 shadow-sm"
                      placeholder="Email Address" required>
              </div>
              <div class="col-12 mt-2">
                <button type="submit" class="btn w-100 rounded-pill fw-bold px-4 py-3 d-flex justify-content-center align-items-center gap-2 shadow-sm"
                        style="background-color: var(--brand-secondary); border-color: var(--brand-secondary); color: var(--brand-primary); letter-spacing: 1px; transition: transform 0.2s ease, box-shadow 0.2s ease;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.1)';" 
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                  SUBSCRIBE TO NEWSLETTER <i class="fa fa-paper-plane ms-2"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Links row -->
      <div class="row g-5 mb-5">
        <div class="col-lg-4 pe-lg-5">
          <div class="mb-4">
            <a href="{{ url('/') }}" class="text-decoration-none d-flex align-items-center">
              <img src="{{ asset('site/images/hargrio_favicon.png') }}" width="40" height="40" alt="Hargrio Logo" class="me-2" style="filter: brightness(0) invert(1);">
              <span class="fs-5 fw-bold" style="letter-spacing: 1px;"><img id="navTextLogo" src="{{ asset('site/images/hargrio_logo_white.png') }}" width="150" height="25" style="transition: all 0.3s ease;"><span style="color: var(--brand-gold);">.</span></span>
            </a>
          </div>
          <p class="mb-4" style="line-height: 1.8;">
            Preserving tradition naturally. We transform under-commercialised heritage grains into high-quality, nutritious blends for modern households.
          </p>
          <ul class="list-unstyled d-flex gap-3 mb-0">
            <li><a href="#" class="text-white opacity-75 text-decoration-none"><span class="fa fa-brands fa-facebook-f fs-5"></span></a></li>
            <li><a href="#" class="text-white opacity-75 text-decoration-none"><span class="fa fa-brands fa-twitter fs-5"></span></a></li>
            <li><a href="#" class="text-white opacity-75 text-decoration-none"><span class="fa fa-brands fa-instagram fs-5"></span></a></li>
            <li><a href="#" class="text-white opacity-75 text-decoration-none"><span class="fa fa-brands fa-linkedin fs-5"></span></a></li>
          </ul>
        </div>

        <div class="col-lg-8">
          <div class="row">
            <div class="col-6 col-md-4 mb-4 mb-md-0">
              <h6 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 1px; font-family: var(--font-family-sans-alt);">Shop</h6>
              <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                <li><a href="{{ route('shop.index') }}" class="text-white text-decoration-none opacity-75">All Products</a></li>
                <li><a href="#" class="text-white text-decoration-none opacity-75">Milla Blend</a></li>
                <li><a href="#" class="text-white text-decoration-none opacity-75">MOAT Blend</a></li>
                <li><a href="#" class="text-white text-decoration-none opacity-75">NutriCore</a></li>
              </ul>
            </div>
            <div class="col-6 col-md-4 mb-4 mb-md-0">
              <h6 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 1px; font-family: var(--font-family-sans-alt);">Company</h6>
              <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                <li><a href="{{ route('about') }}" class="text-white text-decoration-none opacity-75">Our Story</a></li>
                <li><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#wholesaleModal" class="text-white text-decoration-none opacity-75">Wholesale</a></li>
                <li><a href="{{ route('blog.index') }}" class="text-white text-decoration-none opacity-75">Recipes &amp; Stories</a></li>
                <li><a href="{{ route('contact') }}" class="text-white text-decoration-none opacity-75">Contact Us</a></li>
              </ul>
            </div>
            <div class="col-6 col-md-4">
              <h6 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 1px; font-family: var(--font-family-sans-alt);">Legal</h6>
              <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                <li><a href="{{ route('legal.privacy') }}" class="text-white text-decoration-none opacity-75">Privacy Policy</a></li>
                <li><a href="{{ route('legal.terms') }}" class="text-white text-decoration-none opacity-75">Terms of Service</a></li>
                <li><a href="{{ route('legal.refunds') }}" class="text-white text-decoration-none opacity-75">Refund Policy</a></li>
                <li><a href="{{ route('legal.allergy') }}" class="text-white text-decoration-none opacity-75">Allergy Disclaimer</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Bottom bar -->
      <div class="row pt-4 border-top" style="border-color: rgba(255,255,255,0.1) !important;">
        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
          <p class="mb-0 small">&copy; <script>document.write(new Date().getFullYear());</script> Hargrio Limited. All Rights Reserved.</p>
        </div>
        <div class="col-md-6 text-center text-md-end">
          <p class="mb-0 small opacity-50">Preserving tradition naturally.</p>
        </div>
      </div>

    </div>
  </footer>
  <!-- ── End Footer ── -->

  <script src="{{ asset('site/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('site/js/tiny-slider.js') }}"></script>
  <script src="{{ asset('site/js/custom.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {

      /* Sticky navbar on scroll */
      var navbar = document.querySelector('.custom-navbar');
      var navLogo = document.getElementById('navTextLogo');
      var logoWhite = "{{ asset('site/images/hargrio_logo_white.png') }}";
      var logoBrown = "{{ asset('site/images/hargrio_logo_brown.png') }}";

      window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
          navbar.classList.add('navbar-sticky');
          if(navLogo) navLogo.src = logoBrown;
        } else {
          navbar.classList.remove('navbar-sticky');
          if(navLogo) navLogo.src = logoWhite;
        }
      });

      /* Auto-close mobile menu when a link is clicked */
      document.querySelectorAll('#navbarsFurni .nav-link:not(.dropdown-toggle)').forEach(function(link) {
        link.addEventListener('click', function() {
          var collapse = document.getElementById('navbarsFurni');
          if (collapse.classList.contains('show')) {
            var bsCollapse = bootstrap.Collapse.getInstance(collapse);
            if (bsCollapse) bsCollapse.hide();
          }
        });
      });

      /* Global scroll-reveal observer */
      var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
      document.querySelectorAll('.scroll-reveal').forEach(function(el) {
        observer.observe(el);
      });

    });
  </script>
  {{-- ========= WHOLESALE MODAL ========= --}}
  <div class="modal fade" id="wholesaleModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content rounded-lg border-0" style="box-shadow: 0 25px 50px rgba(0,0,0,0.15);">
              <div class="modal-header border-0 pb-0 pt-4 px-4 px-md-5">
                  <div>
                      <h5 class="text-uppercase mb-2" style="color: var(--brand-secondary); letter-spacing: 2px; font-size: 0.75rem; font-family: var(--font-family-sans-alt); font-weight: 600;">PARTNER WITH US</h5>
                      <h3 class="modal-title font-serif fw-bold" style="color: var(--brand-primary);">Wholesale Inquiry</h3>
                  </div>
                  <button type="button" class="btn-close ms-auto mb-auto" data-bs-dismiss="modal" aria-label="Close" style="border: 1px solid #eaeaea; border-radius: 50%; padding: 0.5rem;"></button>
              </div>
              <div class="modal-body p-4 p-md-5 pt-3">
                  <p class="text-muted mb-4 border-bottom pb-4" style="font-size: 0.95rem;">Fill out the form below and our wholesale team will contact you within 24 hours to discuss pricing and partnerships.</p>
                  <form method="POST" action="{{ route('wholesale.inquiry') }}">
                      @csrf
                      <div class="row g-4">
                          <div class="col-md-6">
                              <label class="form-label text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Business Name *</label>
                              <input type="text" name="business_name" class="form-control form-control-lg border-0 bg-light" style="border-radius: 8px;" required>
                          </div>
                          <div class="col-md-6">
                              <label class="form-label text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Contact Name *</label>
                              <input type="text" name="contact_name" class="form-control form-control-lg border-0 bg-light" style="border-radius: 8px;" required>
                          </div>
                          <div class="col-md-6">
                              <label class="form-label text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Email Address *</label>
                              <input type="email" name="email" class="form-control form-control-lg border-0 bg-light" style="border-radius: 8px;" required>
                          </div>
                          <div class="col-md-6">
                              <label class="form-label text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Phone Number *</label>
                              <input type="tel" name="phone" class="form-control form-control-lg border-0 bg-light" style="border-radius: 8px;" required>
                          </div>
                          <div class="col-md-6">
                              <label class="form-label text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Business Type *</label>
                              <select name="business_type" class="form-select form-select-lg border-0 bg-light text-muted" style="border-radius: 8px;" required>
                                  <option value="">Select business type</option>
                                  <option value="bakery">Bakery</option>
                                  <option value="restaurant">Restaurant</option>
                                  <option value="retail">Retail Store</option>
                                  <option value="distributor">Distributor</option>
                                  <option value="other">Other</option>
                              </select>
                          </div>
                          <div class="col-md-6">
                              <label class="form-label text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Est. Monthly Volume *</label>
                              <select name="volume" class="form-select form-select-lg border-0 bg-light text-muted" style="border-radius: 8px;" required>
                                  <option value="">Select volume range</option>
                                  <option value="50-100">50–100 kg</option>
                                  <option value="100-500">100–500 kg</option>
                                  <option value="500-1000">500–1,000 kg</option>
                                  <option value="1000+">1,000+ kg</option>
                              </select>
                          </div>
                          <div class="col-12">
                              <label class="form-label text-muted small fw-bold text-uppercase" style="letter-spacing: 1px;">Additional Information</label>
                              <textarea name="message" rows="4" class="form-control border-0 bg-light" style="border-radius: 8px;" maxlength="500" placeholder="Tell us about specific products you're interested in..."></textarea>
                          </div>
                      </div>
                      <div class="mt-5 text-end border-top pt-4">
                          <button type="button" class="btn btn-link text-muted text-decoration-none me-3 fw-bold" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary px-5 py-3 rounded-pill fw-bold" style="background-color: var(--brand-primary); border-color: var(--brand-primary); letter-spacing: 1px;">Submit Inquiry</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

</body>

</html>
