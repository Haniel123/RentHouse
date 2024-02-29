<!DOCTYPE html>
<html>

<head>
    {{-- <title>Xác nhận tài khoản</title> --}}
</head>

<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>
    <a href="{{ route('user.mat-khau-moi-get', ['email' => $mailData['email'], 'token' => $mailData['token']]) }}">Nhấn vào đây để xác nhận email !</a>
    <p>Cảm ơn!</p>
</body>

</html>
