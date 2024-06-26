<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="" href="{{ asset('images/logocircle.png') }}" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="{{ asset('css/login-signup.css') }}" />
    <title>Sign in & Sign up Form</title>
  </head>
  
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
        <form method="POST" action="{{ route('login') }}" class="sign-in-form"  onsubmit="checkErrors()">
            @csrf
            <h2 class="title">Sign in</h2>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i> 
                    <input type="password" name="password" placeholder="Password" required/>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            <input type="submit" value="{{ __('Log in') }}" class="btn solid" onclick=""/>
            <a href="{{ route('password.request') }}"><p class="social-text">Forgot password?</p></a>
          </form>
          <form method="POST" action="{{ route('register') }}" class="sign-up-form"  onsubmit="checkErrors()">
            @csrf 
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="name" placeholder="Username" required/>
              <x-input-error :messages="$errors->get('name')" class="error-login" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" placeholder="Email" required/>
              <x-input-error :messages="$errors->get('email')" class="error-login" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" required/>
              <x-input-error :messages="$errors->get('password')" class="error-register" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password_confirmation" placeholder="Confirm Password"required/>
              <x-input-error :messages="$errors->get('password_confirmation')"   class="error-register" />
            </div>
            <input type="submit" class="btn" value="{{ __('Register') }}" />
          </form>
        </div>
      </div>
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here?</h3>
            <p>
              Let us help you sign up so we could further provide you with our services.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="{{ asset('images/boom.png') }}" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us?</h3>
            <p>
            Please proceed to log in to access all the wonderful features and resources available to you. Let's embark on this journey together as one of us!
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="{{ asset('images/life.png') }}" class="image" alt="" />
        </div>
      </div>
    </div>
    <div id="toaster"></div>
    <script src="{{ asset('javascript/login-signup.js') }}"></script>
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
  </body>
  
</html> 