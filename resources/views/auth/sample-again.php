<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/loginRester.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" type="" href="{{ asset('images/logocircle.png') }}" />
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="name" placeholder="User name" required="">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
					<input type="email" name="email" placeholder="Email" required="">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
					<input type="password" name="password" placeholder="Password" required="">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <input type="password" name="password_confirmation" placeholder="Password" required="">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
					<button type="submit">{{ __('Register') }}</button>
				</form>
			</div>

			<div class="login">
               <form method="POST" action="{{ route('login') }}">
                    @csrf
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
					<input type="password" name="password" placeholder="Password" required="">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
					<button type="submit">{{ __('Log in') }}</button>
				</form>
                @if (Route::has('password.request'))
                <a class="forgot-pass" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
                <label for="remember_me" class="">
                    <input id="remember_me" type="checkbox" class="" name="remember">
                    <span class="">{{ __('Remember me') }}</span>
                </label>
      
			</div>
            
	</div>
</body>
</html>