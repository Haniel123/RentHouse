<!DOCTYPE html>
<html>

<head>
    {{-- <title>Nicesnippets.com</title> --}}
</head>

<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>
    <a href="{{ route('user.xac-nhan-tai-khoan', ['id' => $mailData['id']]) }}">Xác nhận !</a>
    <p>Cảm ơn!</p>
</body>

</html>
