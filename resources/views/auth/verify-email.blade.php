<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ asset('css/home_style.css') }}">
    <link rel="icon" type="" href="{{ asset('images/logocircle.png') }}" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Add CSS here for responsiveness */
        @media screen and (max-width: 768px) {
            table {
                width: 100% !important;
            }
        }
    </style>
</head>
<body>
    
<table class="container" style="font-family: Helvetica, Arial, sans-serif; background: #fff; margin: 0 auto; width: 90%; max-width: 650px;">
    <tr>
    <td style="padding-top: 40px; padding-bottom: 40px;">
    <div class="imga">
    <p style="text-align: center;"><img src="{{ asset('images/logocircle.png') }}" alt="" style="width: 100px; height: 100px;"></p>
</td>
</div>
    </tr>
</table>
<br><br><br><br>
<table class="container" style="font-family: Helvetica, Arial, sans-serif; background: #fff; margin: 0 auto; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; width: 90%; max-width: 650px;">
    <tr>
        <td style="padding-top: 40px; padding-bottom: 40px; padding-left: 10px; padding-right: 10px; text-align: center;">
            
            <h1 style="font-size: 40px; font-weight: 100; margin-bottom: 20px; color: #2334d1;">You're almost there</h1>
            <p style="font-size: 20px; margin-bottom: 30px; line-height: 26px;">Thank you for signing up for Queen's Clinic.<br> Click the button below to verify your email and start conversing.</p>
            @if (session('status') == 'verification-link-sent')
                <p style="font-size: 10px; margin-bottom: 15px; line-height: 15px;"><br> Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>
            @endif
            <form method="POST" action="{{ route('verification.send') }}" id="myform">
            @csrf
                <a href="#" onclick="document.getElementById('myform').submit()" style="margin-bottom: 30px; display: inline-block; background: #2334d1; color: #fff; text-decoration: none; padding: 20px 30px; border-radius: 10px; font-size: 20px;">{{ __('Resend Verification Email') }}</a><br>
            </form>
            <a href="{{ route('welcome') }}" style="margin-bottom: 30px; display: inline-block; background: #2334d1; color: #fff; text-decoration: none; padding: 20px 30px; border-radius: 10px; font-size: 15px;">Back</a>
        </td>
    </tr>
</table>

<table class="container" style="font-family: Helvetica, Arial, sans-serif; background: #fff; margin: 0 auto; width: 90%; max-width: 650px;">
    <tr>
        <td style="padding-top: 40px; padding-bottom: 40px; padding-left: 10px; padding-right: 10px; text-align: center;">
            
        </td>
    </tr>
</table>    

</body>
</html>
