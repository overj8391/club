<html lang="ru" class="">

<head>
    <meta charset="utf-8">
    <title>Авторизация</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/back/login/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="/back/login/app.css" type="text/css">
    <script src="/back/bower_components/jquery/dist/jquery.min.js"></script>
</head>

<body>
    <div class="app app-header-fixed">
        <div class="container w-xxl w-auto-xs">
            <a href="" class="navbar-brand block m-t">Панель управления</a><span></span>
            <div class="m-b-lg">
                @include('backend.partials.messages')
                <form name="form" method="post" class="form-validation" action="<?= route('backend.auth.login.post') ?>">
                    <input type="hidden" value="<?= csrf_token() ?>" name="_token">
                    <div class="text-danger wrapper text-center" ng-show="authError"></div>
                    <div class="list-group list-group-sm">
                        <div class="list-group-item">
                            <input type="text" placeholder="Username" name="username" class="form-control no-border" required="">
                        </div>
                        <div class="list-group-item">
                            <input type="password" placeholder="Password" name="password" class="form-control no-border" required="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Войти</button>
                    <div class="line line-dashed"></div>
                </form>
            </div>
            <div class="text-center"><p><small class="text-center"><br></small></p></div>
        </div>
    </div>
</body>
</html>

@section('scripts')
    {!! JsValidator::formRequest('VanguardLTE\Http\Requests\Auth\LoginRequest', '#login-form') !!}
@stop
