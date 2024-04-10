<!DOCTYPE html>
<html lang="ru">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="HandheldFriendly" content="true"/>
    <meta name="viewport" content="initial-scale=1,width=device-width,maximum-scale=2,minimum-scale=0.5,user-scalable=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('code')</title>
    <link rel="stylesheet" href="/frontend/Default/css/style.min.css">
    <link type="image/png" rel="icon" href="/frontend/Default/img/favicon.png">
</head>
<body>
<main class="error">
    <div class="container">
        <div class="error__code">@yield('code')</div>
        <p>@yield('message')</p>
        <a href="/" class="btn">Вернуться на главную</a>
    </div>
</main>
</body>
</html>
