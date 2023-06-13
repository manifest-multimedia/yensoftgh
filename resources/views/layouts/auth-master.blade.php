<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{(asset('assets/css/auth.css'))}}">
</head>
<body>
    <div class="login-page">
        <div class="form">

        @yield('content')

        </div>
    </div>


</body>
</html>
