<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực tài khoản</title>
    <link rel="stylesheet" href="{{ asset('css/email.css') }}">
</head>
<body>
    <p>Vui lòng nhấp vào liên kết sau để xác minh Email của bạn:</p>
    <a href="{{ url('/verify-email/' . $token) }}">Xác thực</a>
    <p>Cảm ơn!</p>
</body>
</html>
