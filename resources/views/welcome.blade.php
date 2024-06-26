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
@if(Session::has('success'))
    <script>
        window.onload = function() {
            alert("{{ Session::get('success') }}");
        }
    </script>
@endif
  <!--===== HEADER ====-->
  <header class="l-header">
    <nav class="nav bd-grid">
      <div>
        <a href="{{route('welcome')}}" class="nav__logo">The Queen's Clinic</a>
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
    <!--===== HOME =====-->
    <section class="home" id="home">
        <div class="home__container bd-grid">
        <h1 class="home__title"><span>Welcome to <br> The Queens <br> Clinic</span><br></h1>
        <img src="{{ asset('images/logo1.png') }}" alt="" class="home__img" style="max-width: 100%; height: auto;">
    </div>
    </section>

    <!--===== ABOUT =====-->
    <section class="about section" id="about">
      <h2 class="section-title">About</h2>
      <div class="about__container bd-grid">
        <div>
          <span class="about__profession"></span>
          <p class="about__text"><b>At The Queen's Clinic</b>, we believe in the transformative power of nurturing and expert care during the precious moments of childbirth. Established with a commitment to providing a safe and supportive environment, our clinic has earned a renowned reputation as a birthing home where the miracle of life is celebrated with warmth and expertise.
            <br><br>
            Our team of experienced and compassionate professionals is dedicated to guiding you through the miraculous journey of childbirth. From prenatal care to postnatal support, we are here for you every step of the way, providing individualized attention and expert medical care.
            <br><br>
            Beyond the birthing home, The Queen's Clinic extends its commitment to family wellness with top-notch <b>pediatric services</b>. Our specialized pediatricians are passionate about ensuring the health and happiness of your little ones. From routine check-ups to addressing specific health concerns, trust us to be your partners in your child's well-being.
            <br><br>
            In addition to our birthing and pediatric services, our clinic is proud to offer state-of-the-art <b>surgical facilities</b>. Our skilled surgeons bring a blend of precision and compassion to every procedure, ensuring that you receive the highest quality care when you need it most.
            <br><br>
            At The Queen's Clinic, we understand the significance of the moments we share with you. Whether you are welcoming a new life, entrusting us with your child's health, or seeking expert surgical care, our commitment remains unwavering. Your well-being is our priority, and we strive to create an environment where every individual feels heard, valued, and cared for.
            <br><br>
          </p>
        </div>
      </div>
    </section>

    <!--===== PORTFOLIO =====-->
    <section class="portfolio section" id="products">
    <h2 class="section-title">Doctors</h2>
    <div class="portfolio__container bd-grid">
        <div class="portfolio__img">
            <img src="{{ asset('images/1.jpg') }}" alt="">
            <div class="portfolio__link">
                <a href="login.html" target="_blank" class="portfolio__link-name">
                    <button class="blue-button">Schedule Now!</button>
                </a>
            </div>
        </div>
        <div class="portfolio__img">
            <img src="{{ asset('images/2.jpg') }}" alt="">
            <div class="portfolio__link">
                <a href="login.html" target="_blank" class="portfolio__link-name">
                    <button class="blue-button">Schedule Now!</button>
                </a>
            </div>
        </div>
        <div class="portfolio__img">
            <img src="{{ asset('images/3.jpg') }}" alt="">
            <div class="portfolio__link">
                <a href="login.html" target="_blank" class="portfolio__link-name">
                    <button class="blue-button">Schedule Now!</button>
                </a>
            </div>
        </div>
        <div class="portfolio__img">
            <img src="{{ asset('images/Intern.jpg') }}" alt="">
            <div class="portfolio__link">
                <a href="login.html" target="_blank" class="portfolio__link-name">
                    <button class="blue-button">Schedule Now!</button>
                </a>
            </div>
        </div>
        <div class="portfolio__img">
            <img src="{{ asset('images/Erness.jpg') }}" alt="">
            <div class="portfolio__link">
                <a href="login.html" target="_blank" class="portfolio__link-name">
                    <button class="blue-button">Schedule Now!</button>
                </a>
            </div>
        </div>
        <div class="portfolio__img">
            <img src="{{ asset('images/Derma.jpg') }}" alt="">
            <div class="portfolio__link">
                <a href="login.html" target="_blank" class="portfolio__link-name">
                    <button class="blue-button">Schedule Now!</button>
                </a>
            </div>
        </div>
    </div>
</section>
        
    <!--===== PORTFOLIOS =====-->
    <section class="portfolios section" id="services">
    <h2 class="section-title">Available Services</h2>
    <div class="portfolios__container bd-grid">
        <div class="portfolio__img">
            <img src="{{ asset('images/Consull.png') }}" alt="">
            <div class="portfolio__link">
                <a href="login.html" target="_blank" class="portfolio__link-name">
                    <button class="blue-button">Schedule Now!</button>
                </a>
            </div>
            <h2 class="h22">Consultation</h2>
        </div>
        <div class="portfolio__img">
            <img src="{{ asset('images/infer.jpg') }}" alt="">
            <div class="portfolio__link">
                <a href="login.html" target="_blank" class="portfolio__link-name">
                    <button class="blue-button">Schedule Now!</button>
                </a>
            </div>
            <h2 class="h22">Pediatrics</h2>
        </div>
        <div class="portfolio__img">
            <img src="{{ asset('images/obyy.jpg') }}" alt="">
            <div class="portfolio__link">
                <a href="login.html" target="_blank" class="portfolio__link-name">
                    <button class="blue-button">Schedule Now!</button>
                </a>
            </div>
            <h2 class="h22">Obygyne</h2>
        </div>
    </div>
</section>

        
    <!--===== CONTACT 
    <section class="contact section" id="contact">
      <h2 class="section-title">Contact</h2>

      <div class="contact__container bd-grid">
        <div class="contact__info">
          <h3 class="contact__subtitle">EMAIL</h3>
          <span class="contact__text">samwanasenrazon@gmail.com</span>

          <h3 class="contact__subtitle">Facebook</h3>
          <span class="contact__text">https://www.facebook.com/thequeensobgyn</span>

          <h3 class="contact__subtitle">ADRESS</h3>
          <span class="contact__text"> 1190C Quirino Highway Novaliches Quezon City, Philippines</span>
        </div>
=====-->
       <!-- <form action="" class="contact__form">
          <div class="contact__inputs">
            <input type="text" placeholder="Name" class="contact__input">
            <input type="mail" placeholder="Email" class="contact__input">
          </div>
          <textarea name="" id="" placeholder="Message" cols="0" rows="10" class="contact__input"></textarea>
         <input type="submit" value="Ask him" class="contact__button">
        </form>
      </div>-->
    </section>
  </main>
  <!--===== FOOTER =====-->
  <footer class="footer section">
    <div class="footer__container bd-grid">
    <div class="footer__data">
    <a href="#about" class="footer__title about-link" style="text-align: left;"><b>ABOUT US</b></a>
      <p class="footer__text"></p>
    </div>
      <div class="footer__data">
      <h2 class="footer__title"style="text-align: left;"><b>BUSINESS HOURS</b></h2>
        <ul>
          <h4 class="footer__title" style="color: white; text-align: left; font-size: 12px; font-weight: normal;">Monday to Sunday 9:00 am - 5:00 pm</h3>
          <br>
          <h2 class="footer__title"style="text-align: left;"><b>ADDRESS</b></h2>
          <li>
              <a href="https://www.google.com/maps/place/The+Queens+OBGYN,+Pediatrics,+and+Surgery+Clinic/@14.7337321,121.0499644,17z/data=!3m1!4b1!4m6!3m5!1s0x3397b192d7ba560f:0xf162619ab0e1610c!8m2!3d14.7337269!4d121.0525393!16s%2Fg%2F11qpvt1zrw?entry=ttu" target="_blank" class="footer__link" style="color: white; text-align: left; font-size: 12px; font-weight: normal;">
                  <span style="border-bottom: 1px solid rgba(255, 255, 255, 0.5);">1190C Quirino Highway Novaliches, <br>
                  Quezon City, Philippines</span>
              </a>
          </li>

        
            <br><br>
            <h2 class="footer__title"style="text-align: left;"><b>BUSINESS HOURS</b></h2>
          <h2 class="footer__title" style="color: white; text-align: left; font-size: 12px; font-weight: normal;">0926-0993874</h2>
        </ul>
      </div>

      <div class="footer__data">
    <h2 class="footer__title"style="text-align: left;"><b>FOLLOW</b></h2>
      <a href="https://www.facebook.com/thequeensobgyn" target="_blank" class="footer__social" style="color: white;"><i class='bx bxl-facebook'></i></a>
      <a href="https://www.instagram.com/thequeensclinic/?hl=en" target="_blank" class="footer__social" style="color: white;"><i class='bx bxl-instagram'></i></a>
        <br><br>
      <div class="fixed-message-button">
              <a href="mailto:samwanasenrazon@gmail.com" class="message-button" style="color: white;"><i class='bx bx-message'></i><b> Email Us</b></a>
          </div>
    </div>

    </div>
  </footer>
  <!--===== SCROLL REVEAL  =====-->
  <script src="https://unpkg.com/scrollreveal"></script>
  <!--===== MAIN JS =====-->
  <script src="{{ asset('javascript/js.js') }}"></script>
</body>
</html>