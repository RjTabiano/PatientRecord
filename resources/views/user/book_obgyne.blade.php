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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
        <h2 class="section-titles">Obgyne</h2>
        <div class="booking_container">
        <form method="post" action="{{route('storeBooking')}}" class="form">
            @csrf
            @method('post')
            <div class="datepicker">
                <label for="date">Select Date:</label>
                <input name="service" type="hidden" width="270" value="obgyne" />
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