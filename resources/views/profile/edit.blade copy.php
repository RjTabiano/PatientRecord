<style>
    /* Shared styles */
    section {
        margin-bottom: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    header {
        margin-bottom: 10px;
    }

    h2 {
        font-size: 1.5rem;
        margin-bottom: 5px;
    }

    p {
        font-size: 1rem;
        margin-bottom: 10px;
    }

    /* Delete Account Section */
    .delete-account form {
        margin-top: 10px;
    }

    .delete-account label {
        display: block;
        margin-bottom: 5px;
    }

    .delete-account input[type="password"] {
        width: calc(250px - 10px);
        margin-bottom: 10px;
        padding-right: 5px;
    }

    /* Update Password Section */
    .update-password input[type="password"] {
        width: calc(250px - 10px);
        margin-bottom: 10px;
        padding: 5px;
    }

    /* Profile Information Section */
    .profile-information input[type="text"],
    .profile-information input[type="email"] {
        width: calc(250px - 10px);
        margin-bottom: 10px;
        padding: 5px;
    }

    .profile-information button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .profile-information button:hover {
        background-color: #0056b3;
    } 

    .profile-information
    .update-password
    .delete-account {
        margin-right: 90px;
    }

    .lob{
        margin-right: 550px;
    }

    .imga{
        margin-right: 60px;
    }

</style>
<x-app-layout>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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

            <button class="lob" >Save</button>

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

      
            
            <button >Save</button>
           
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</x-app-layout>