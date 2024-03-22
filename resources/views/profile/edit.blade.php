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
  <!--===== HEADER =====-->
  <header class="l-header">
    <nav class="nav bd-grid">
      <div>
        <a href="{{route('welcome')}}" class="nav__logo">The Queen's Clinic</a>
      </div>

      <div class="nav__menu" id="nav-menu">
        <ul class="nav__list">
        <li class="nav__item"><a href="{{route('welcome')}}" class="nav__link active">Home</a></li>
        <li class="nav__item"><a href="#about" class="nav__link">About</a></li>
        <li class="nav__item"><a href="#products" class="nav__link">Doctors</a></li>
        <li class="nav__item"><a href="#services" class="nav__link">Services</a></li>
        @if (Route::has('login'))
            @auth
                <li class="nav__item"><a href="{{route('services')}}" class="nav__link">Book Now!</a></li>
                @cannot('user')
                  <li class="nav__item"><a href="{{route('home')}}" class="nav__link">Admin Panel</a></li>
                @endcan
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
 <br><br><br><br>
<td style="padding-top: 30px; padding-bottom: 30px;">
    <div class="imga">
    <p style="text-align: center;"></p>
</td>

<section class="profile-information">
    <header>
        
        <h2>Profile Information</h2>
        <p>Update your account's profile information and email address.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div>
            <label class="form-label" for="name">Name</label>
            <input id="name" class="form-control" name="name" type="text" placeholder="Name" required autofocus autocomplete="name" value="{{ old('name', $user->name) }}">
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label  class="form-label" for="email">Email</label>
            <input class="form-control" id="email" name="email" type="email" placeholder="Email" required autocomplete="username" value="{{ old('email', $user->email) }}">
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p>Your email address is unverified. <br><button form="send-verification">Click here to re-send the verification email.</button></p>
                    @if (session('status') === 'verification-link-sent')
                        <p>A new verification link has been sent to your email address.</p>
                    @endif
                </div>
            @endif
        </div>
            
            <button>Save</button>

            @if (session('status') === 'profile-updated')
                <p>{{ __('Saved.') }}</p>
            @endif
    </form>
</section>



 
<section class="update-password">
    <header>
        <h2>Update Password</h2>
        <p>Ensure your account is using a long, random password to stay secure.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div>
            <label class="form-label" for="update_password_current_password">Current Password</label>
            <input class="form-control" id="update_password_current_password" name="current_password" type="password" placeholder="Current Password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div>
            <label class="form-label" for="update_password_password">New Password</label>
            <input class="form-control" id="update_password_password" name="password" type="password" placeholder="New Password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="form-label" for="update_password_password_confirmation">Confirm Password</label>
            <input class="form-control" id="update_password_password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

      
            
            <button>Save</button>
           
            @if (session('status') === 'password-updated')
                <p>{{ __('Saved.') }}</p>
            @endif
     
    </form>
</section>




<section class="delete-account">
    <header>
        <h2>Delete Account</h2>
        <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Delete Account') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <h2>Are you sure you want to delete your account?</h2>

            <p>Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>

            <div>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Password">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div>
                <button type="button" onclick="$dispatch('close')">Cancel</button>
                <button class="ms-3" type="submit">Delete Account</button>
            </div>
        </form>
    </x-modal>


</section>
  <!--===== SCROLL REVEAL =====-->
  <script src="https://unpkg.com/scrollreveal"></script>
  <!--===== MAIN JS =====-->
  <script src="{{ asset('javascript/js.js') }}"></script>
</body>

</html>