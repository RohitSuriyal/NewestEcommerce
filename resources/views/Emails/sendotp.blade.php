<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f9f9f9; padding:20px;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" style="background:#fff; padding:20px; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,.1)">
                    <tr>
                        <td align="center">
                            <h2 style="color:#333;">Hello, {{ $user->email }}</h2>
                            <p style="font-size:16px; color:#555;">Here is your OTP code:</p>
                            <h1 style="color:#2c7be5; font-size:32px;">{{ $otp }}</h1>
                            <p style="font-size:14px; color:#888;">This OTP is valid for 10 minutes.</p>
                            <br>
                            <p style="font-size:14px; color:#aaa;">Thanks,<br>Your App Team</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
