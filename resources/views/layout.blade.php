<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>
    <?php
        $user = Auth::user();
    ?>
    <h3>
        user ID : {{$user->id}} <br>
        user name : {{$user->name}}
    </h3>
    @yield('content')
</body>
</html>
