<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="{{ asset('css/home_style.css') }}">
    <link rel="icon" type="" href="{{ asset('images/logocircle.png') }}" />
    <!-- ===== BOX ICONS ===== -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
   

  <title>The Queen's Clinic</title>
</head>

<body>
  <!--===== HEADER =====-->
  <header class="l-header">
    <nav class="nav bd-grid">
      <div>
        <a href="#" class="nav__logo">The Queen's Clinic</a>
      </div>

      <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
        <li class="nav__item"><a href="#home" class="nav__link active">Home</a></li>
        <li class="nav__item"><a href="#about" class="nav__link">About</a></li>
        <li class="nav__item"><a href="#products" class="nav__link">Doctors</a></li>
        <li class="nav__item"><a href="#services" class="nav__link">Services</a></li>
        <li class="nav__item"><a href="#contact" class="nav__link">Contact</a></li>
        @if (Route::has('login'))
            @auth
                <li class="nav__item"><a href="" class="nav__link">Book Now!</a></li>
                <li class="nav__item"><a href="{{route('profile.edit')}}" class="nav__link">{{ Auth::user()->name }}</a></li>
            @else
                <li class="nav__item"><a href="{{ route('login') }}" class="nav__link">Log in</a></li>

                @if (Route::has('register'))
                <li class="nav__item"><a href="{{ route('register') }}" class="nav__link">Register</a></li>
                @endif
            @endauth
    @endif

        </ul>
      </div>

      <div class="nav__toggle" id="nav-toggle">
        <i class='bx bx-menu'></i>
      </div>
    </nav>
  </header>
 <body>
  <main class="l-main">
    <section class="portfolios section" id="services">
        <h2 class="section-title">Pediatrics</h2>
        <div class="booking_container">
        <form method="post" action="{{route('storeBooking')}}" class="form">
            @csrf
            @method('post')
            <div class="datepicker">
                <label for="date">Select Date:</label>
                <input name="service" type="hidden" width="270" value="pediatrics" />
                <input name="date" type="date" width="270" />
            </div>
            <div class="timepicker">
                <label for="time">Select Time:</label>
                <input name="time" type="time" width="270" />
            </div>
            <button type="submit">Book</button>
        </form>
        </div>
    </section>
  </main>
  <script src="{{ asset('javascript/js.js') }}"></script>
</body>

</html>