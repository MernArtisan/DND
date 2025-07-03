<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            padding: 40px;
        }

        h1 {
            color: #d82e2e;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            margin: 20px 0;
            padding: 12px 24px;
            background-color: #d82e2e;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 13px;
            color: #888;
            margin-top: 30px;
        }

        .btn:hover {
            background-color: #b82323;
        }

        .reset-link {
            word-break: break-all;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>Password Reset Request</h1>
        <p>Hello,</p>
        <p>You are receiving this email because we received a password reset request for your account.</p>

        <p style="text-align: center;">
            <a href="{{ $link }}" class="btn">Reset Password</a>
        </p>

        <p>If the button above doesn't work, copy and paste the URL below into your browser:</p>
        <p class="reset-link">{{ $link }}</p>

        <p>This password reset link will expire in 60 minutes.</p>

        <p>If you didn’t request a password reset, no further action is required.</p>

        <p>Regards,<br>Your Website Team</p>

        <div class="footer">
            &copy; {{ date('Y') }} Your Company Name. All rights reserved.
        </div>
    </div>
</body>

</html>