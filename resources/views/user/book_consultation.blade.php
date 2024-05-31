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
        <li class="nav__item"><a href="{{route('welcome')}}" class="nav__link ">Home</a></li>
        <li class="nav__item"><a href="#about" class="nav__link">About</a></li>
        <li class="nav__item"><a href="#products" class="nav__link">Doctors</a></li>
        <li class="nav__item"><a href="#services" class="nav__link">Services</a></li>
        @if (Route::has('login'))
            @auth
                <li class="nav__item"><a href="{{route('services')}}" class="nav__link">Schedule Now!</a></li>
                @cannot('user')
                  <li class="nav__item"><a href="{{route('home')}}" class="nav__link">Admin Panel</a></li>
                @endcan
                
<!-- HTML -->
<li class="nav__item dropdown">
  <a href="#" class="nav__link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                 <a href="{{route('myAppointment')}}">Appointment</a><br>
                <a href="{{route('myPatientRecord')}}">Patient Record</a><br>
                <a href="{{route('myConsultationRecord')}}">Consultation Record</a>
  </div>
</li>
                <li class="nav__item"><a href="{{route('profile.edit')}}" class="nav__link">{{ Auth::user()->name }}</a></li>
            @else
                <li class="nav__item"><a href="{{ route('login') }}" class="nav__link">Sign In/Sign Up</a></li>
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
        <h2 class="section-titles">Consultation</h2>
        <div class="booking_container">
        <form method="post" action="{{route('storeBooking')}}" class="form">
            @csrf
            @method('post')
            <div class="datepicker">
                <label for="date">Select Date:</label>
                <input name="service" type="hidden" width="270" value="consultation" />
                <input name="date" type="date" width="270" min="{{ date('Y-m-d') }}" />
            </div>
            <div class="timepicker">
            <select id="timeSelect" name="time">
              <option value="07:00:00">7:00 AM</option>
              <option value="07:30:00">7:30 AM</option>
              <option value="08:00:00">8:00 AM</option>
              <option value="08:30:00">8:30 AM</option>
              <option value="09:00:00">9:00 AM</option>
              <option value="09:30:00">9:30 AM</option>
              <option value="10:00:00">10:00 AM</option>
              <option value="10:30:00">10:30 AM</option>
              <option value="11:00:00">11:00 AM</option>
              <option value="11:30:00">11:30 AM</option>
              <option value="12:00:00">12:00 PM</option>
              <option value="12:30:00">12:30 PM</option>
              <option value="13:00:00">1:00 PM</option>
              <option value="13:30:00">1:30 PM</option>
              <option value="14:00:00">2:00 PM</option>
              <option value="14:30:00">2:30 PM</option>
              <option value="15:00:00">3:00 PM</option>
              <option value="15:30:00">3:30 PM</option>
              <option value="16:00:00">4:00 PM</option>
              <option value="16:30:00">4:30 PM</option>
              <option value="17:00:00">5:00 PM</option>
            </select>
          </div>
            <div class="timepicker">
                <label for="number">Phone Number:</label>
                <input name="phone_number" type="number" width="270" />
            </div>
            <button type="submit">Book</button>
        </form>
        </div>
        <div id="toaster"></div>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @foreach ($errors->all() as $error)
                    showToast("{{ $error }}", 'error');
                @endforeach
            });

            function showToast(message, type) {
                const toaster = document.getElementById('toaster');

                const toast = document.createElement('div');
                toast.className = 'toast ' + (type === 'error' ? 'toast-error' : 'toast-success');

                const description = document.createElement('div');
                description.className = 'description';
                description.textContent = message;

                const cancelButton = document.createElement('button');
                cancelButton.className = 'cancel-button';
                cancelButton.textContent = 'Dismiss';
                cancelButton.addEventListener('click', () => hideToast(toast));

                toast.appendChild(description);
                toast.appendChild(cancelButton);

                toaster.appendChild(toast);

                setTimeout(() => hideToast(toast), 3000); // Hide toast after 3 seconds
            }

            function hideToast(toast) {
                toast.classList.add('hide');
                toast.addEventListener('transitionend', () => toast.remove());
            }
        </script>
    @endif

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showToast("{{ session('success') }}", 'success');
            });
        </script>
    @endif
    </section>
  </main>
  <script src="{{ asset('javascript/js.js') }}"></script>
</body>
</html>