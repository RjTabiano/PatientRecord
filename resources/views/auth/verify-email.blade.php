
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Queen's Clinic Verification</title>
    <link rel="icon" href="{{ asset('images/logocircle.png') }}" type="image/png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .lkj {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .lkj h1 {
            font-size: 40px;
            font-weight: 100;
            margin-bottom: 20px;
            color: #2334d1;
        }

        .lkj p {
            font-size: 20px;
            margin-bottom: 30px;
            line-height: 26px;
        }

        .lkj form {
            margin-bottom: 30px;
        }

        .lkj a.btn {
            display: inline-block;
            background: #2334d1;
            color: #fff;
            text-decoration: none;
            padding: 10px 30px;
            border-radius: 10px;
            font-size: 15px;
            margin-bottom: 1px;
        }

        .lkj a.btn.back {
            background: #2334d1;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="BGBG">
<img src="{{ asset('images/FIREE.JPG') }}" alt="Queen's Clinic Logo" style="width: 100px; height: 100px;">
</div>
<div class="container">
        <div class="lkj">
            <div class="imga">
                <p>
                    <img src="{{ asset('images/logocircle.png') }}" alt="Queen's Clinic Logo" style="width: 100px; height: 100px;">
                </p>
            </div>
            <h1>You're almost there</h1>
            <p>Thank you for signing up for Queen's Clinic.<br> Click the button below to verify your email and start conversing.</p>
            @if (session('status') == 'verification-link-sent')
                <p>Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
            @endif
            <form method="POST" action="{{ route('verification.send') }}" id="myform">
                @csrf
                <a href="#" onclick="document.getElementById('myform').submit()" class="btn">{{ __('Resend Verification Email') }}</a><br>
            </form>
            <a href="{{ route('welcome') }}" class="btn back">Back</a>
        </div>
    </div>
</body>
</html>

